  <?php

  $module =  $_REQUEST["module"];
  
  $btnrequest = Site::obtain_post("btnrequest");

  $art = article::Get( article::getActiveArticle($module));
  
  $NB_ART_PAGE = 10;
 
  $p = @$_GET['p'];
  if($p>=1)
  	$p--;
  
  $offset = $p*$NB_ART_PAGE;
  
  $p++;
  $start = microtime(true);
  $location_coords = Site::GetCoords($s_a_loc);
  $cat = category_article::returnCategoryForSearch($s_a_cat);
  
  $name = category_article::returnNameForSearch($s_a_name);
  
  $number_art_search = article::GetSearchResults($cat,$name,$location_coords,'','',true);
  
  $max_page = ceil($number_art_search / $NB_ART_PAGE);
  $tab_art_search = article::GetSearchResults($cat,$name,$location_coords,$offset,$NB_ART_PAGE);
  
  $end = microtime(true);
  
  

 $product = product::getProduct($module);
 
 $prodID = $product['prod_id'];
 $prodName = $product['prod_name'];
 $prodDesc = $product['prod_desc'];
 $prodFirstPic = $art->get_first_picture();
 
 //for prod category
 $categoryArticle = $art->getCatName();
 
  $articleCaution = $art->getAttr('cat');
  $articlePrice = $art->getAttr('price');
  
  //for multi date picker
  $art_dates = $art->getAttr('dates');
  
  
  //getting owner name
  $prodOwnerID = $product['prod_user_id'];
  $prodOwner = product::getOwner($prodOwnerID);
  
  $prodOwnerName = $prodOwner['user_lastname']." ".$prodOwner['user_firstname'];
  
  $prodOwnerEmail = $prodOwner['user_email'];
  $prodOwnerPwd = $prodOwner['user_password'];
  
  
  $productAddress = address::getById($prodOwner['user_address']);
  
  if (count($productAddress)) {
  	$productAddress = $productAddress[0][0];
  	
  	$prodOwnerCity = $productAddress->getAttr('city');
  }
  
  $lat = $productAddress->addr_latitude;
  $lng = $productAddress->addr_longitude;
  
  $me = Session::myLoc();
  
  $prodAndOwnerDistance = address::getDistance($me->getSmallAddress(), array($lat, $lng));
  	
  
  
  
  $productAddedOn = $product['prod_date_creation'];
  
  
  
  if($btnrequest !="" )
  {		
		if (Session::Online()==false)
		{
			Site::message_info("Vous devez être connecté pour emprunter l'objet.","ERROR");
		}
		else
		{
			if (Session::Me()->isUserActive()){
				
				@$requ_date_from = Site::obtain_post("requ_date_from");
				@$requ_date_to = Site::obtain_post("requ_date_to");
				@$requ_message = Site::obtain_post("requ_message");
				@$card_id = Site::obtain_post('card_id');
				

				//initialisation de la variable error
				$error =""; 
				
				//gestion des erreurs sur les champs
				if($requ_date_from == "")
				{
					$error="votre champs date debut n'est pas remplie";
					
				}
				if($requ_date_to =="")
				{
					$error="votre champs date fin n'est pas remplie";
					
				}
				if ($requ_message =="")
				{
					$error="votre champs message n'est pas remplie";
				}
				
				if(strlen($requ_message)<10)
				{
					$error="votre champs message n'as pas plus de 10 caractere";
					
				}
			
			/* ...*/
			//gestion des contrainte sur les champs
			if(request::isAvailableWithDate($module,$requ_date_from,$requ_date_to)==true)
				{
					$error="votre produit est deja pris a cette date";
					
				}
				// Nombre de jours demandés
				$requ_nb_days = ((Site::md2php($requ_date_to) - Site::md2php($requ_date_from)) / 86400);
			if ($requ_nb_days < 1) 
				{
					$error = "La durée de l'emprunt est trop courte";
					
				}
			 if (Site::md2php($requ_date_from) > Site::md2php($requ_date_to))
				{
					$error = "La date de début d'emprunt doit précéder la date de fin";
				}
				
			if (($error == "") && (Site::md2php($requ_date_from) < Site::md2php(Site::now())))
				{
					$error = "La date de début d'emprunt est dépassée";
				}
			if (($error == "") && (Site::md2php($requ_date_from)) > Site::md2php($requ_date_to))
				{
					$error = "La date de début d'emprunt doit précéder la date de fin";
				}
				$prix=(Session::me()->getAttr('credit'));
				//calculer du prix total
				$PrixTotal=($requ_nb_days*$art->getMutumByDay());
			if ($prix<$PrixTotal)
				{
					$error = "Vous n'avez pas assez de crédit pour emprunter cet article sur cette durée";
				}
		
				
			if ($card_id=="" && $art->getAttr('caution')!="0")
				{
					$error = "Aucune carte n'a été renseigné.";
				}
				$mangopay=(mangopay::check_card_owner($card_id,Session::me()->getAttr('id')));
				
			if	($mangopay==false)
				{
					$error = "Erreur: cette carte ne vous appartient pas !";
				}
				
				
					
          
			/* ...*/
			if($error=="")
			{		$caution=null;
					if($art->getAttr('caution')>"0"){
					$caution = new caution();
					$caution->setAttr('amount',$art->getAttr('caution'));
					$caution->setAttr('card_id',$card_id);
					$caution->setAttr('caua_id',null);
					$caution=$caution->Insert();}
					
					
					$discussion = new discussion;
					$discussion->setAttr('all_grant_invit','0');
					$discussion->setAttr('date_creation',Site::now());
					$discussion->setAttr('name','emprunt de '.$art->getAttr('name'));
					$discussionID=$discussion->Insert();
					
					$unMessage= new message;
					$unMessage->setAttr('user_id', Session::Me()->getAttr('id'));
					$unMessage->setAttr('text',$requ_message);
					$unMessage->setAttr('date_creation',Site::now());
					$unMessage->setAttr('class','');
					$unMessage->setAttr('disc_id',$discussionID);
					$unMessage->Insert();
					
					//calculer du prix total
					$PrixTotal=($requ_nb_days*$art->getMutumByDay());
					//gain de mutum de l'utilisateur
					Site::add_score_to_user (Session::Me()->getAttr('id'),$art->getMutumByDay(),'Emprunt_creation');
					//insertion dans la base de données
					$register_request = new request();
					$register_request ->setAttr('lender_id',$art->getAttr('user_id'));
				    $register_request ->setAttr('borrower_id',Session::Me()->getAttr('id'));
					$register_request ->setAttr('prod_id',$module);
					$register_request ->setAttr('date_creation',Site::now());
					$register_request ->setAttr('date_from',$requ_date_from);
					$register_request ->setAttr('date_to',$requ_date_to);
					$register_request ->setAttr('prol_id',null);
					$register_request ->setAttr('credit',$PrixTotal);
					$register_request ->setAttr('discussion',$discussionID);
					$register_request ->setAttr('code',null);
					$register_request ->setAttr('status','1');
					$register_request ->setAttr('lender_nota_id',null);
					$register_request ->setAttr('borrower_nota_id',Session::Me()->getAttr('notation'));
					$register_request ->setAttr('prod_note',0);
					$register_request ->setAttr('lender_archive',0);
					$register_request ->setAttr('borrower_archive',0);
					$register_request ->setAttr('lender_read',0);
					$register_request ->setAttr('borrower_read',0);
					$register_request ->setAttr('caut_id',$caution);
					$register_request->Insert();
					
					
					
					
					
			
			}
			else
			{
				Site::message_info($error,"ERROR");				
				include (Site::include_view("view"));
			}
			
			}
			else
			{
				echo " vous devez d'abord activer votre e-mail";
				include (Site::include_view("view"));
		// renvoyer vers mail d'activation
			}
		}		
  }	
  else
  {
  	  $owner = user::getUser($art->getAttr('user_id'))[0][0];
	  include (Site::include_view("view"));
	 
  }
  
  

	
?>
