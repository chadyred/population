      /*foreach($individu->getLogement()->getAdresse()->getRue()->getTroncons() as $unTroncon)
            {
                echo true;
            }*/

            //On vérifie que l'adresse lié au troncon dans le résultat de la requête est permise au sein de ce dernier
            if(isset($this->secteurs) && count($this->secteurs) > 0)
            {

                 echo 'Taille début du tableau avant suppression : ' . count($arrayResults);
                 echo 'Nombre de troncon en tableau' . $nbTroncon . '<br/>';
                 echo 'Nombre de troncons en objet ' . $nbTronconObj . '<br/>';


                 for($i = 0;$i < count($arrayResults);$i++)
                 {
                     //Initialisation : il est censé être deans le secteur à la base
                    $presentDansSecteur = true;

                    //On récupère le numéro de la rue
                    $numeroRue = $arrayResults[$i]['Famille']['Logement']['Adresse']['numeroRue'];

                    //On parcours tout les troncons pour cette adresse dans la rue dans laquelle elle se situe (une adresse n'a qu'une rue)
                    for($j = 0;$j < $nbTroncon;$j++)
                    {
                        $minImp = $arrayResults[$i]['Famille']['Logement']['Adresse']['Rue']['Troncons'][$j]['numDebutImpair'];
                        $maxImp = $arrayResults[$i]['Famille']['Logement']['Adresse']['Rue']['Troncons'][$j]['numFinImpair'];
                        $minPair = $arrayResults[$i]['Famille']['Logement']['Adresse']['Rue']['Troncons'][$j]['numDebutPair'];
                        $maxPair = $arrayResults[$i]['Famille']['Logement']['Adresse']['Rue']['Troncons'][$j]['numFinPair'];

                        //On vérifie si l'adresse est dans l'intervalle
                        if(Troncon::getAdresseDisponible($numeroRue, $minImp, $maxImp, $minPair, $maxPair))
                        {
                            //Si c'est la cas on garde
                            echo "Ce troncon est dans les clou !<br/>";
                            $presentDansSecteur = true;
                        }
                        else
                        {
                            //Isnon on la vire...mais elle peut repasser à true si dans un autre troncons elle est présente
                            echo "Ce troncon n'est pas dans les clou !<br/>";
                            echo '<pre>';
                            print_r($arrayResults[$i]);
                            echo '</pre>';
                            $presentDansSecteur = false;
                        }
                    }

                    //S'il n'a rien à faire là on supprime ce dernier du tableau
                    if($presentDansSecteur == false)
                    {
                        unset($arrayResults[$i]);
                    }

                 }

                 echo 'Taille final du tableau après suppression : ' . count($arrayResults);
            }