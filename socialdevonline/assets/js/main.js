function validation()
		{
			var email 	= document.formulaire.email.value;
   			var verif 	= /^[a-zA-Z0-9_-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/
   			if (verif.exec(email) == null)
			{
				alert("Votre email est incorrecte");
				return false;
			}
			else
			{
				alert("Votre email est correcte");
				return true;
			}	

		}