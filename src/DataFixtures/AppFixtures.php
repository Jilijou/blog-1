<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Article();
        $article->setName("Article Zobmalin");
        $article->setContenu("Lorem ipsum");
        $article->setSlug("article-zobmalin");
        $manager->persist($article);

        for ($i = 0; $i < 10; $i++) {

            $contact = new Contact();
            $contact->setName("ADSL");
            $contact->setFirstName("Gadget");
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
