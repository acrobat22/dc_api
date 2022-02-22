<?php



namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{

    // Définition de la constante indiquant le nombre maximum d'article retourné
    const NB_MAX_ARTICLES = 25;
    // Définition de la constante
    const URL_RSS = 'https://www.lemonde.fr/rss/en_continu.xml';

    /**
     * Récupération du fichier RSS d'actualité et stockage des données dans la variable $datas
     */
    public function getRss()
    {
        // Stockage du fichier XML dans la variable $rss
        $rss = simplexml_load_file(self::URL_RSS);

        // variable qui va stocké les éléments parsés
        $datas=[];
        // Définition du nombre maximum d'article retourné
        $nb_max_articles = self::NB_MAX_ARTICLES;

        // Test si nombre d'article retourné est < à 25 dans ce cas on prend cette valeur
        if(count($rss->channel->item) < $nb_max_articles){
            $nb_max_articles =count($rss->channel->item);
        }

        // Boucle enregistant les données récupérées dans $datas
        for($i = 0; $i < $nb_max_articles; $i++){
            //on recupere les champs de chaque articles
            $arrayArticle['id']= $i;
            $arrayArticle['title']= (string)$rss->channel->item[$i]->title;
            $arrayArticle['description']= (string)$rss->channel->item[$i]->description;
            $arrayArticle['media']= (string)$rss->channel->item[$i]->children( 'media', True )->content->attributes()['url'];
            $arrayArticle['date']= (string)$rss->channel->item[$i]->pubDate;
            $arrayArticle['guid']= (string)$rss->channel->item[$i]->guid;
            $datas[$i]=$arrayArticle;
        }

        return $datas;
    }

    /**
     * Affiche tous les articles (qté = 25)
     * @Route("/", name="homepage", methods={"GET"})
     * @return Response
     */
    public function listeNews()
    {
        // Récupération de l'ensemble des articles
        $datas = $this->getRss();

        // Envoi à la vue de tous les articles
        return $this->render('news/news.html.twig', [
            'datas' => $datas
        ]);
    }

    /**
     * Affiche l'article choisi
     * @Route("/api/new/{id}", name="oneNew", methods={"GET"})
     * @param $id
     * @return Response
     */
    public function oneNew($id)
    {
        // Récupération de l'ensemble des articles
        $datas = $this->getRss();

        // Envoi à la vue l'article qui correspond à l'id sélectionné figurant
        return $this->render('news/new.html.twig', [
            'data' => $datas[$id]
        ]);
    }

}
