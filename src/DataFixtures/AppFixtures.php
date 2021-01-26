<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Province;
use App\Entity\Shop;
use App\Entity\User;
use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\ProductFactory;
use App\Factory\ProvinceFactory;
use App\Factory\ShopFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::new()->createMany(40);

        /*UserFactory::new()->create([
            'roles' => ['ROLE_ADMIN'],
            'password' => 'admin',
            'email' => 'admin@admin.com',
        ]); */


        // CATEGORIES
        $category1 = new Category();
        $category1->setLabel('Fromages');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setLabel('Vins');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setLabel('Bières');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setLabel('Fruits et Légumes');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setLabel('Boulangerie');
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setLabel('Poissons');
        $manager->persist($category6);

        $category7 = new Category();
        $category7->setLabel('Viandes');
        $manager->persist($category7);


        //CategoryFactory::new()->createMany(7);


        // PROVINCE
        $province1 = new Province();
        $province1->setProvinceName('Rhônes');
        $manager->persist($province1);

        $province2 = new Province();
        $province2->setProvinceName('Ain');
        $manager->persist($province2);

        $province3 = new Province();
        $province3->setProvinceName('Savoie');
        $manager->persist($province3);

        //ProvinceFactory::new()->createMany(3);


        // SHOP
        $shop1 = new Shop();
        $shop1->setShopName('La Boutique Savoyarde');
        $shop1->setShopDescription('La Boutique Savoyarde est née en 2009 d\'un constat simple : les produits savoyards sont très peu présents sur le net.<br>Depuis plus de 10 ans, le catalogue de la boutique n\'a cessé de grandir. En plus des autocollants, drapeaux et tee-shirts présents dès l\'ouverture du site, vous trouverez également des livres, des écussons, des paniers garnis, des boissons... Plusieurs centaines de produits sont aujourd\'hui disponibles.<br>La Boutique Savoyarde a aussi pour objectif de mettre en relation les producteurs locaux savoyards et tous ceux qui veulent consommer local ou profiter de nos bons produits en dehors de nos montagnes.<br>Tous les produits sur le site sont conçus ou produits en Savoie !');
        $shop1->setShopPicture('shop1.jpg');
        $shop1->setShopPhone('0783928399');
        $shop1->setShopAddress('46 chemin des petits champs<br>74600 Annecy');
        $shop1->setProvince($province3);
        $manager->persist($shop1);

        $shop2 = new Shop();
        $shop2->setShopName('Coopérative laitière de la Chambre');
        $shop2->setShopDescription('Située au cœur de la Maurienne, notre coopérative collecte, fabrique et affine en Beaufort, le lait de 22 producteurs fiers de leur métier.<br>- Maintien des valeurs ancestrales<br>- Esprit 100% nature<br>- Atelier moderne et récent<br>- En direct des producteurs');
        $shop2->setShopPicture('shop2.png');
        $shop2->setShopPhone('0479560090');
        $shop2->setShopAddress('710 Grande Rue<br>73130 La Chambre');
        $shop2->setProvince($province3);
        $manager->persist($shop2);

        $shop3 = new Shop();
        $shop3->setShopName('Le caveau Bugiste');
        $shop3->setShopDescription('Niché au sommet du village de Vongnes, le Caveau Bugiste met à votre disposition un espace d\'accueil complet. Après avoir flâné dans le village réputé pour ses fleurs et son authenticité, vous pourrez profiter de nos musées et de notre Vinorama.<br>Producteur de Vins du Bugey depuis 1967, nous proposons aujourd\'hui plus de 30 cuvées que nous aurons plaisir à vous faire découvrir. Il est aussi possible de commander dans notre boutique en ligne et de vous faire livrer chez vous.');
        $shop3->setShopPicture('shop3.png');
        $shop3->setShopPhone('0479879232');
        $shop3->setShopAddress('326 rue de la Vigne des Bois<br>01350 Vongnes');
        $shop3->setProvince($province2);
        $manager->persist($shop3);

        $shop4 = new Shop();
        $shop4->setShopName('Maréchal fraicheur');
        $shop4->setShopDescription('Fiers de notre profession, dans la famille Maréchal nous sommes producteurs agricole à Vancia, aux portes de Lyon et de la Dombes, depuis 1886.<br>Cultivant d\'abord des herbes aromatiques, nos grands parents étaient travaillaient en polyculture.<br>Ils se sont ensuite tournés progressivement vers les légumes en produisant des salades, carottes, choux, poireaux, oignons, épinards en fonction des saisons. Ils les commercialisaient alors sur l\'historique Quai Saint Antoine (en face du Vieux Lyon) !');
        $shop4->setShopPicture('shop4.png');
        $shop4->setShopPhone('0615397366');
        $shop4->setShopAddress('Chemin de Rosarge<br>69140 Rillieux-la-Pape');
        $shop4->setProvince($province1);
        $manager->persist($shop4);

        $shop5 = new Shop();
        $shop5->setShopName('L\'ami d\'pain');
        $shop5->setShopDescription('L\'ami d\'pain est né d\'un couple, amoureux du bon pain, un artisan boulanger et une vendeuse. Nous vous accueillons dans une ambiance chaleureuse et vous proposons tout un éventail de produits de notre fabrication. Notre entreprise est une société (SARL) constituée de 2 associés inscrite à la Chambre de métiers et de l\'artisan et au registre des commerces.<br>Pour élaborer notre gamme de pains nous travaillons avec le moulin Forest, minotier situé en Saône-et-Loire et différents fournisseurs de la région de l\'Ain pour les matières premières.<br>Tous nos fruits et légumes frais proviennent du primeur "Jany fruits" situé à Bourg en Bresse.');
        $shop5->setShopPicture('shop5.png');
        $shop5->setShopPhone('0474248608');
        $shop5->setShopAddress('41 rue Bourgmayer<br>01000 Bourg en Bresse');
        $shop5->setProvince($province2);
        $manager->persist($shop5);

        $shop6 = new Shop();
        $shop6->setShopName('Marbled Beef');
        $shop6->setShopDescription('Né et grandi dans une grande ferme au contact des éleveurs expérimentés, des chefs-bouchers renommés et des chefs-cuisiniers héritiers de vieilles traditions culinaires je suis moi-même professionnel de la viande depuis 9 ans.<br>J\'ai travaillé dans toutes les filières de la viande à tous les niveaux de responsabilité depuis la ferme jusqu\'aux cuisines en passant par les boucheries traditionnelles et la gestion des rayons de boucherie. J\'ai ainsi acquis une connaissance solide dans la sélection des meilleures viandes en tant que professionnel passionné de son métier.<br> Créateur de Marbled Beef, avant de devenir chef-boucher, j\'ai eu la chance d\'être l\'apprenti des grands maîtres de qui j\'ai appris l\'éthique du métier que je partage avec mon équipe. Nous restons ainsi attachés à ces traditions artisanales d\'exigence du travail bien fait pour donner du meilleur de nous au service des autres et partager notre passion de la viande.');
        $shop6->setShopPicture('shop6.png');
        $shop6->setShopPhone('0164480746');
        $shop6->setShopAddress('12 Avenue Georges Clemenceau<br>69160 Tassin-la-Demi-Lune');
        $shop6->setProvince($province1);
        $manager->persist($shop6);

        $shop7 = new Shop();
        $shop7->setShopName('Luximer');
        $shop7->setShopDescription('LUXIMER s’engage à vendre des produits de la mer accessibles à tous, géographiquement mais aussi financièrement.<br>Nous pouvons ainsi proposer des prix producteurs qui peuvent variés au jour le jour, en fonction du cours de la pêche.<br>Cependant, nous garantissons à nos clients les prix accordés le jour de la commande et non celui du jour de l’expédition');
        $shop7->setShopPicture('shop7.jpg');
        $shop7->setShopPhone('0970160351');
        $shop7->setShopAddress('112 Boulevard de la Croix-Rousse<br>69001 Lyon');
        $shop7->setProvince($province1);
        $manager->persist($shop7);

        //ShopFactory::new()->createMany(10);


        // ADMIN
        $admin1 = new User();
        $admin1->setShop($shop1);
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin1->setEmail('admin1@admin1.com');
        $admin1->setPassword($this->encoder->encodePassword($admin1, 'admin1'));
        $admin1->setFirstname('admin');
        $admin1->setLastname('admin');
        $admin1->setUserAddress('41 rue jobin<br>Chambéry');
        $admin1->setPostalCode('73000');
        $admin1->setUserPhone('0752321456');
        $manager->persist($admin1);

        $admin2 = new User();
        $admin2->setShop($shop2);
        $admin2->setRoles(['ROLE_ADMIN']);
        $admin2->setEmail('admin2@admin2.com');
        $admin2->setPassword($this->encoder->encodePassword($admin2, 'admin2'));
        $admin2->setFirstname('admin');
        $admin2->setLastname('admin');
        $admin2->setUserAddress('19 rue des augustins<br>Lyon');
        $admin2->setPostalCode('69009');
        $admin2->setUserPhone('0624896532');
        $manager->persist($admin2);

        $admin3 = new User();
        $admin3->setShop($shop3);
        $admin3->setRoles(['ROLE_ADMIN']);
        $admin3->setEmail('admin3@admin3.com');
        $admin3->setPassword($this->encoder->encodePassword($admin3, 'admin3'));
        $admin3->setFirstname('admin');
        $admin3->setLastname('admin');
        $admin3->setUserAddress('85 avenue Charles de Gaulle<br>Bourg en Bresse');
        $admin3->setPostalCode('01000');
        $admin3->setUserPhone('0669547895');
        $manager->persist($admin3);

        $admin4 = new User();
        $admin4->setShop($shop4);
        $admin4->setRoles(['ROLE_ADMIN']);
        $admin4->setEmail('admin4@admin4.com');
        $admin4->setPassword($this->encoder->encodePassword($admin4, 'admin4'));
        $admin4->setFirstname('admin');
        $admin4->setLastname('admin');
        $admin4->setUserAddress('10 place Verdun<br>Francheville');
        $admin4->setPostalCode('69340');
        $admin4->setUserPhone('0678954112');
        $manager->persist($admin4);

        $admin5 = new User();
        $admin5->setShop($shop5);
        $admin5->setRoles(['ROLE_ADMIN']);
        $admin5->setEmail('admin5@admin5.com');
        $admin5->setPassword($this->encoder->encodePassword($admin5, 'admin5'));
        $admin5->setFirstname('admin');
        $admin5->setLastname('admin');
        $admin5->setUserAddress('14 avenue des Laurier<br>Aussois');
        $admin5->setPostalCode('73500');
        $admin5->setUserPhone('0785566321');
        $manager->persist($admin5);

        $admin6 = new User();
        $admin6->setShop($shop6);
        $admin6->setRoles(['ROLE_ADMIN']);
        $admin6->setEmail('admin6@admin6.com');
        $admin6->setPassword($this->encoder->encodePassword($admin6, 'admin6'));
        $admin6->setFirstname('admin');
        $admin6->setLastname('admin');
        $admin6->setUserAddress('17 rue des amandiers<br>Mouxy');
        $admin6->setPostalCode('73100');
        $admin6->setUserPhone('0645551478');
        $manager->persist($admin6);

        $admin7 = new User();
        $admin7->setShop($shop7);
        $admin7->setRoles(['ROLE_ADMIN']);
        $admin7->setEmail('admin7@admin7.com');
        $admin7->setPassword($this->encoder->encodePassword($admin7, 'admin7'));
        $admin7->setFirstname('admin');
        $admin7->setLastname('admin');
        $admin7->setUserAddress('108 rue de Charlemagne<br>Marboz');
        $admin7->setPostalCode('01851');
        $admin7->setUserPhone('0612225874');
        $manager->persist($admin7);



        // PRODUCT
        $product1 = new Product();
        $product1->setProductName('Blanche du Mont-Blanc');
        $product1->setProductDescription('1 bouteille ou pack de 3, 6 ou 12 bouteilles de bière blanche du Mont-Blanc. Brasserie de Mont-Blanc.<br>Bière brassée en Savoie.<br>Froment, coriandre et écorce d\'orange.');
        $product1->setProductPicture('product1.png');
        $product1->setPrice(2.31);
        $product1->setStock(10);
        $product1->setSlug('Blanche-du-Mont-Blanc');
        $product1->setCategory($category3);
        $product1->setShop($shop1);
        $product1->setProvince($province3);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setProductName('Rousse du Mont-Blanc');
        $product2->setProductDescription('1 bouteille ou pack de 3, 6 ou 12 bouteilles de bière rousse du Mont-Blanc. Brasserie de Mont-Blanc.<br>Bière brassée en Savoie.<br>Ambrée spéciale aux 3 malts.');
        $product2->setProductPicture('product2.png');
        $product2->setPrice(2.31);
        $product2->setStock(10);
        $product2->setSlug('Rousse-du-Mont-Blanc');
        $product2->setCategory($category3);
        $product2->setShop($shop1);
        $product2->setProvince($province3);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setProductName('Blonde du Mont-Blanc');
        $product3->setProductDescription('1 bouteille ou pack de 3, 6 ou 12 bouteilles de bière blonde du Mont-Blanc. Brasserie de Mont-Blanc.<br>Bière brassée en Savoie.<br>Bière de dégustation : Malts et épices.');
        $product3->setProductPicture('product3.png');
        $product3->setPrice(3.30);
        $product3->setStock(5);
        $product3->setSlug('Blonde-du-Mont-Blanc');
        $product3->setCategory($category3);
        $product3->setShop($shop1);
        $product3->setProvince($province3);
        $manager->persist($product3);

        $product4 = new Product();
        $product4->setProductName('Frisson des cimes');
        $product4->setProductDescription('Pack de 1, 3 ou 6 bouteilles de vin rouge Frisson des Cimes, domaine Curtet Marie & Florian.<br>A.O.P. Vin de Savoie BIO.<br>Millésime 2018 - 75cl.');
        $product4->setProductPicture('product4.jpg');
        $product4->setPrice(19.92);
        $product4->setStock(20);
        $product4->setSlug('Frisson-des-cimes');
        $product4->setCategory($category2);
        $product4->setShop($shop1);
        $product4->setProvince($province3);
        $manager->persist($product4);

        $product5 = new Product();
        $product5->setProductName('Tonnere de grès');
        $product5->setProductDescription('Pack de 1, 3 ou 6 bouteilles de vin blanc Tonnerre de Grès, domaine Curtet Marie & Florian.<br>A.O.P. Vin de Savoie BIO.<br>Millésime 2018 - 75cl.');
        $product5->setProductPicture('product5.jpg');
        $product5->setPrice(17.52);
        $product5->setStock(25);
        $product5->setSlug('Tonnere-de-grès');
        $product5->setCategory($category2);
        $product5->setShop($shop1);
        $product5->setProvince($province3);
        $manager->persist($product5);

        $product6 = new Product();
        $product6->setProductName('Chignin bergeron sous les amandiers');
        $product6->setProductDescription('Un hommage à la beauté de l’amandier en fleurs, arbre emblématique de Chignin.<br>Il se déguste jeune mais sait s’épanouir avec le temps.<br>Pack de 1, 3 ou 6 bouteilles.<br>Vin blanc BIO Chignin Bergeron A.O.P<br>Millésime 2018 - 75cl');
        $product6->setProductPicture('product6.jpg');
        $product6->setPrice(18.90);
        $product6->setStock(15);
        $product6->setSlug('Chignin-bergeron-sous-les-amandiers');
        $product6->setCategory($category2);
        $product6->setShop($shop1);
        $product6->setProvince($province3);
        $manager->persist($product6);

        $product7 = new Product();
        $product7->setProductName('Abondance');
        $product7->setProductDescription('Issue de la Vallée d\'Abondance, qui lui a donné son nom, ce fromage au lait cru d\'une dizaine de kilos à l\'allure de « petit Beaufort » vous ravira par sa saveur fruitée. Il bénéficie d’une AOP depuis 1996 et fait partie intégrante de notre fameuse recette de fondue savoyarde avec le Beaufort et l\'Emmental de Savoie.');
        $product7->setProductPicture('product7.jpg');
        $product7->setPrice(8.60);
        $product7->setStock(3);
        $product7->setSlug('Abondance');
        $product7->setCategory($category1);
        $product7->setShop($shop2);
        $product7->setProvince($province3);
        $manager->persist($product7);

        $product8 = new Product();
        $product8->setProductName('Beaufort ete');
        $product8->setProductDescription('Il est notre produit phare !! Produit uniquement durant la période d’alpage (1er juin -> 31 octobre), son goût plus prononcé et plus fruité est représentatif de la diversité de la flore pâturée par nos animaux. On peut le reconnaître à sa couleur légèrement plus dorée. Il ensoleillera vos plateaux de fromages et ainsi que vos recettes les plus originales.');
        $product8->setProductPicture('product8.jpg');
        $product8->setPrice(9.40);
        $product8->setStock(25);
        $product8->setSlug('Beaufort-ete');
        $product8->setCategory($category1);
        $product8->setShop($shop2);
        $product8->setProvince($province3);
        $manager->persist($product8);

        $product9 = new Product();
        $product9->setProductName('Tomme de Savoie');
        $product9->setProductDescription('Bénéficiant d’une IGP depuis 1996, elle est pourtant fabriquée en Savoie depuis des générations. Elle se distingue grâce à une croute grise et plutôt fleurie, et une pâte blanche à jaunâtre présentant de petits trous. Sa texture à la fois souple et ferme révèle un gout plus ou moins prononcé en fonction de la durée de l\'affinage.');
        $product9->setProductPicture('product9.jpg');
        $product9->setPrice(4);
        $product9->setStock(9);
        $product9->setSlug('Tomme-de-Savoie');
        $product9->setCategory($category1);
        $product9->setShop($shop2);
        $product9->setProvince($province3);
        $manager->persist($product9);

        $product10 = new Product();
        $product10->setProductName('Reblochon fermier');
        $product10->setProductDescription('Fabriqué 2 fois par jour à la ferme avec le lait chaud d’un seul et même troupeau. Sa fabrication est entièrement manuelle et on le reconnaît à sa pastille de caséine de couleur verte. Sa saveur est plus affirmée que le Reblochon laitier mais sa texture tout aussi onctueuse.');
        $product10->setProductPicture('product10.jpg');
        $product10->setPrice(10.95);
        $product10->setStock(7);
        $product10->setSlug('Reblochon-fermier');
        $product10->setCategory($category1);
        $product10->setShop($shop2);
        $product10->setProvince($province3);
        $manager->persist($product10);

        $product11 = new Product();
        $product11->setProductName('Raclette de Savoie');
        $product11->setProductDescription('Outre la traditionnelle « raclette party », la Raclette de Savoie vous fera découvrir son gout franc et parfumé même sur un plateau. Reconnaissable à sa croute orangée et à sa pâte ferme et très fondante, elle se fera l\'alliée parfaite de vos soirées en famille ou entre amis. Combinez-la à la Raclette fumée pour plus de saveurs.<br>Il faut compter environ 200 g de Raclette par personnes selon les appétits');
        $product11->setProductPicture('product11.jpg');
        $product11->setPrice(7.45);
        $product11->setStock(30);
        $product11->setSlug('Raclette-de-Savoie');
        $product11->setCategory($category1);
        $product11->setShop($shop2);
        $product11->setProvince($province3);
        $manager->persist($product11);

        $product12 = new Product();
        $product12->setProductName('Emmental de Savoie');
        $product12->setProductDescription('Le plus gros fromage savoyard, de la famille des gruyères, comporte le marquage rouge « Savoie » sur le talon pour se démarquer de son homologue français. Sa pâte jaune est parsemée de gros trous caractéristiques. Il s\'agit également d\'un fromage au lait cru issu d\'élevages de Savoie et Haute-Savoie. Retrouvez-le également dans la recette de la fondue savoyarde avec le Beaufort et l\'Abondance.');
        $product12->setProductPicture('product12.jpg');
        $product12->setPrice(16.90);
        $product12->setStock(15);
        $product12->setSlug('Emmental-de-Savoie');
        $product12->setCategory($category1);
        $product12->setShop($shop2);
        $product12->setProvince($province3);
        $manager->persist($product12);

        $product13 = new Product();
        $product13->setProductName('Chardonnay Cuvee Vieilles Vignes');
        $product13->setProductDescription('Issu de parcelles âgées de plus de 50 ans, planté sur des coteaux argilo-calcaires, le Chardonnay Vieilles Vignes est récolté à la main.<br>Produit avec de petits rendements, c\'est un vin concentré aux arômes intenses de fruits exotiques et d\'agrumes auxquels se mêlent des parfums de fleurs blanches, de vanille et d\'amande. La bouche est ample, souple, équilibrée, avec une longueur remarquable. Il peut sans complexe trouver sa place sur les plus grandes tables de France. Le millésime 2015 a eu l\'honneur de figurer dans le Top 10 des Meilleurs Chardonnay du Monde (Concours International des Meilleurs Chardonnay du Monde 2017).<br>Il accompagnera les mets les plus raffinés : cuisses de grenouilles, poissons du lac ou encore poulet de Bresse à la crème.<br>Très fruité dans sa jeunesse, sa richesse lui permet cependant de vieillir quelques années en bouteille.');
        $product13->setProductPicture('product13.jpg');
        $product13->setPrice(9.40);
        $product13->setStock(15);
        $product13->setSlug('Chardonnay-Cuvee-Vieilles-Vignes');
        $product13->setCategory($category2);
        $product13->setShop($shop3);
        $product13->setProvince($province2);
        $manager->persist($product13);

        $product14 = new Product();
        $product14->setProductName('Manicle blanc cuvee des Eboulis');
        $product14->setProductDescription('Le Manicle Blanc est un cru du Bugey situé sur la commune de Cheignieu La Balme. Planté sur des coteaux en forte pente, exposés plein sud, il bénéficie d\'un ensoleillement exceptionnel, et également d\'un terrain particulier, composé d\'éboulis de montagne. Le Chardonnay trouve à Manicle une expression très particulière qui a fait la réputation de ce cru depuis la révolution française.<br>Le Manicle Blanc, vendangé à la main, est vinifié et élevé en fûts sur lies durant 6 mois. Une robe dorée, un nez très puissant d\'amande grillée, de noisette, de vanille et d\'acacia ; en bouche, un bel équilibre, beaucoup de rondeur avec une finale mentholée, le Manicle Blanc va évoluer vers des arômes de miel, d\'abricot, de figue si l\'on a la patience de le laisser vieillir quelques années. C\'est un vin corsé, riche et aromatique qui se mariera à merveille avec les volailles à la crème, les quenelles ou les poissons grillés.');
        $product14->setProductPicture('product14.jpg');
        $product14->setPrice(14.50);
        $product14->setStock(8);
        $product14->setSlug('Manicle-blanc-cuvee-des-Eboulis');
        $product14->setCategory($category2);
        $product14->setShop($shop3);
        $product14->setProvince($province2);
        $manager->persist($product14);

        $product15 = new Product();
        $product15->setProductName('Machuraz rouge');
        $product15->setProductDescription('Au pied du château de Machuraz, ce magnifique terroir composé d\'éboulis calcaires est particulièrement propice à la Mondeuse, cépage typique du Bugey. Ce Machuraz rouge est élevé en fûts sur fines lies pendant au moins un an.<br>On découvre une belle robe rubis aux reflets bleutés et, au nez, des arômes chaleureux à dominante de fruits rouges et noirs : myrtille et cassis notamment. En bouche, l\'attaque est ferme, une pointe boisée et se termine sur une finale épicée. Aux notes de fruits rouges s\'ajoutent le pruneau et la vanille.<br>Cette cuvée s\'accorde à merveille avec les terrines de gibier, les viandes en sauce, les fromages de caractère ou, pour surprendre vos invités, avec un dessert au chocolat noir.');
        $product15->setProductPicture('product15.jpg');
        $product15->setPrice(12.20);
        $product15->setStock(13);
        $product15->setSlug('Machuraz-rouge');
        $product15->setCategory($category2);
        $product15->setShop($shop3);
        $product15->setProvince($province2);
        $manager->persist($product15);

        $product16 = new Product();
        $product16->setProductName('Pinot Rose');
        $product16->setProductDescription('De par son cépage, le Pinot donne un rosé plus corsé que le Gamay, mais aussi plus fin, aux arômes subtils.<br>Son nez caractéristique de fruits rouges (fraise, framboise) et de fruits noirs (cassis) en fait un vin séduisant. En bouche, c\'est un vin structuré et complexe avec une belle fraicheur en finale.<br>Il s\'associe avec bonheur aux fritures et aux viandes blanches, mais saura aussi se montrer agréable avec les crudités, salades ou barbecue.');
        $product16->setProductPicture('product16.jpg');
        $product16->setPrice(7.20);
        $product16->setStock(18);
        $product16->setSlug('Pinot-Rose');
        $product16->setCategory($category2);
        $product16->setShop($shop3);
        $product16->setProvince($province2);
        $manager->persist($product16);

        $product17 = new Product();
        $product17->setProductName('Pommes Gala 1KG');
        $product17->setProductDescription('Pommes Gala de notre collègue Sylvain, producteur à Saint Genis Laval (69) !<br>1 kg de pommes Gala (environ 6/7 pommes).<br>Cette pomme est l\'un des plus grands classiques de ce fruit !<br>Pommes cultivées en agriculture raisonnée.');
        $product17->setProductPicture('product17.jpg');
        $product17->setPrice(2.70);
        $product17->setStock(50);
        $product17->setSlug('Pommes-Gala-1KG');
        $product17->setCategory($category4);
        $product17->setShop($shop4);
        $product17->setProvince($province1);
        $manager->persist($product17);

        $product18 = new Product();
        $product18->setProductName('Poires passe crassane 1KG');
        $product18->setProductDescription('Connu pour avoir de la cire rouge sur le bout de sa queue (ce qui augmente sa durée de conservation), la poire passe crassane représente la poire de Noël.<br>Les poires passe crassane s\'exprimeront totalement en les consommant à leur couleur de maturité : le jaune. Nous livrons parfois ces poires un peu vertes pour qu\'elles résistent au transport dans les paniers. Aussi, n\'hésitez pas à les faire mûrir à température ambiante, près de quelques pommes. Attention, il ne faut pas non plus attendre qu\'elles tendent vers le marron pour les consommer !<br>Poids : 1 kg environ (5/6 poires)<br>Poires cultivées en agriculture raisonnée.');
        $product18->setProductPicture('product18.jpg');
        $product18->setPrice(3.20);
        $product18->setStock(38);
        $product18->setSlug('Poires-passe-crassane-1KG');
        $product18->setCategory($category4);
        $product18->setShop($shop4);
        $product18->setProvince($province1);
        $manager->persist($product18);

        $product19 = new Product();
        $product19->setProductName('Kiwis de la Drome 1KG');
        $product19->setProductDescription('Des kiwis cultivés à Châteauneuf sur Isère (26), par notre jeune collègue arboriculteur Quentin. A rajouter à votre panier de Fruits et Légumes !<br>10 kiwis (environ 1 kg) - Catégorie 1<br>calibre 30 (env 100g/kiwi)<br>variété Hayward<br>Kiwis cultivés en agriculture raisonnée.');
        $product19->setProductPicture('product19.jpg');
        $product19->setPrice(3.80);
        $product19->setStock(50);
        $product19->setSlug('Kiwis-de-la-Drome-1KG');
        $product19->setCategory($category4);
        $product19->setShop($shop4);
        $product19->setProvince($province1);
        $manager->persist($product19);

        $product20 = new Product();
        $product20->setProductName('Salade verte Batavia');
        $product20->setProductDescription('Salade vendue à l\'unité ; salade cueillie du matin à Vancia (69) pour vous assurer une fraîcheur imbattable !<br>Batavia cultivée en agriculture raisonnée.');
        $product20->setProductPicture('product20.jpg');
        $product20->setPrice(1.30);
        $product20->setStock(25);
        $product20->setSlug('Salade-verte-Batavia');
        $product20->setCategory($category4);
        $product20->setShop($shop4);
        $product20->setProvince($province1);
        $manager->persist($product20);

        $product21 = new Product();
        $product21->setProductName('Mache 200GR');
        $product21->setProductDescription('200 gr de mâche fraîche de l\'exploitation de la famille Hérard, cultivée sous abris froids à Ampuis - 69<br>Mâche cultivée en agriculture raisonnée.');
        $product21->setProductPicture('product21.jpg');
        $product21->setPrice(3.50);
        $product21->setStock(18);
        $product21->setSlug('Mache-200GR');
        $product21->setCategory($category4);
        $product21->setShop($shop4);
        $product21->setProvince($province1);
        $manager->persist($product21);

        $product22 = new Product();
        $product22->setProductName('Pleurotes grises 250GR');
        $product22->setProductDescription('Des pleurotes grises fraîchement récoltées !<br>Celles-ci sont cultivées localement, à côté de notre exploitation, sur un site magnifique : l\'ancien fort militaire de Vancia (69) ! Ce lieu connait aujourd\'hui une deuxième jeunesse (activités scolaires variées, accro-branche, etc..) et consacre notamment une partie de ses vieilles voûtes empierrées à la culture de champignons ! Une aubaine pour ce producteur voisin qui profite de conditions exceptionnelles très propices.<br>250 g de pleurotes grises à ajouter à votre panier de Fruits et Légumes pour le compléter selon votre envie !');
        $product22->setProductPicture('product22.jpg');
        $product22->setPrice(2.80);
        $product22->setStock(5);
        $product22->setSlug('Pleurotes-grises-250GR');
        $product22->setCategory($category4);
        $product22->setShop($shop4);
        $product22->setProvince($province1);
        $manager->persist($product22);

        $product23 = new Product();
        $product23->setProductName('Courges Shiatsu 1KG');
        $product23->setProductDescription('La courge Shiatsu est une jolie courge à la peau noire et la chair orange.<br>Elle se cuisine comme une autre courge classique. A noter : sa peau est dure.<br>Pour plus de facilité en cuisine, coupez la en gros morceau, faites-la bouillir puis retirez la chair avec une cuillère.<br>Courge cultivée sur des terres cultivées en agriculture raisonnée');
        $product23->setProductPicture('product23.jpg');
        $product23->setPrice(2.30);
        $product23->setStock(30);
        $product23->setSlug('Courges-Shiatsu-1KG');
        $product23->setCategory($category4);
        $product23->setShop($shop4);
        $product23->setProvince($province1);
        $manager->persist($product23);

        $product24 = new Product();
        $product24->setProductName('Pain complet');
        $product24->setProductDescription('À partir d\'une farine complète type 150 biologique.');
        $product24->setProductPicture('product24.jpg');
        $product24->setPrice(5);
        $product24->setStock(12);
        $product24->setSlug('Pain-complet');
        $product24->setCategory($category5);
        $product24->setShop($shop5);
        $product24->setProvince($province2);
        $manager->persist($product24);

        $product25 = new Product();
        $product25->setProductName('Pain au cereales');
        $product25->setProductDescription('7 céréales & 7 graines');
        $product25->setProductPicture('product25.jpg');
        $product25->setPrice(3.40);
        $product25->setStock(10);
        $product25->setSlug('Pain-au-cereales');
        $product25->setCategory($category5);
        $product25->setShop($shop5);
        $product25->setProvince($province2);
        $manager->persist($product25);

        $product26 = new Product();
        $product26->setProductName('Baguette de tradition Francaise');
        $product26->setProductDescription('Cette baguette est fabriquée à partir d\'une farine pure de première qualité, sans additif, peu pétrie et façonnée à la main.<br>Une longue fermentation lui confère cette saveur unique de froment, un alvéolage irrégulier et un croustillant exceptionnel.<br>La "Rolls-Royce" de la baguette !');
        $product26->setProductPicture('product26.jpg');
        $product26->setPrice(1.20);
        $product26->setStock(23);
        $product26->setSlug('Baguette-de-tradition-Francaise');
        $product26->setCategory($category5);
        $product26->setShop($shop5);
        $product26->setProvince($province2);
        $manager->persist($product26);

        $product27 = new Product();
        $product27->setProductName('La Tarte Bressane');
        $product27->setProductDescription('une tarte briochée pur beurre, garnie de crème et de sucre. (différents parfums sur demande : nature, praline, chocolat, fruits rouges...)<br>A savourer entre amis ou en famille.');
        $product27->setProductPicture('product27.png');
        $product27->setPrice(4.80);
        $product27->setStock(5);
        $product27->setSlug('La-Tarte-Bressane');
        $product27->setCategory($category5);
        $product27->setShop($shop5);
        $product27->setProvince($province2);
        $manager->persist($product27);

        $product28 = new Product();
        $product28->setProductName('Framboisier');
        $product28->setProductDescription('Un gâteau à la fois doux et acidulé, plein de fraîcheur.<br>Une généreuse génoise nature, une crème onctueuse à la framboise et des framboises.');
        $product28->setProductPicture('product28.jpg');
        $product28->setPrice(11.90);
        $product28->setStock(3);
        $product28->setSlug('Framboisier');
        $product28->setCategory($category5);
        $product28->setShop($shop5);
        $product28->setProvince($province2);
        $manager->persist($product28);

        $product29 = new Product();
        $product29->setProductName('Fraisier');
        $product29->setProductDescription('Délicieux biscuit imbibé de sirop, garni de crème mousseline et de fraises fraîches, les amateurs de dessert à base de fruits seront ravis !');
        $product29->setProductPicture('product29.jpg');
        $product29->setPrice(11.99);
        $product29->setStock(3);
        $product29->setSlug('Fraisier');
        $product29->setCategory($category5);
        $product29->setShop($shop5);
        $product29->setProvince($province2);
        $manager->persist($product29);

        $product30 = new Product();
        $product30->setProductName('Filet de Boeuf Angus nourri a l\'herbe 1KG');
        $product30->setProductDescription('Le filet de boeuf Angus d\'Argentine. Merveilleusement tendre, ce filet a une saveur intense et profonde qui fait sensation. Le filet est le muscle le plus tendre de tous. Primés pour cette raison, nos steaks au filet offrent une expérience gustative délicieuse. Si vous les souhaitez tendres, vous allez adorer cette coupe!');
        $product30->setProductPicture('product30.jpg');
        $product30->setPrice(65.94);
        $product30->setStock(20);
        $product30->setSlug('Filet-de-Boeuf-Angus-nourri-a-l-herbe-1KG');
        $product30->setCategory($category7);
        $product30->setShop($shop6);
        $product30->setProvince($province1);
        $manager->persist($product30);

        $product31 = new Product();
        $product31->setProductName('Noix d\'Entrecote USDA Prime Black Angus 1KG');
        $product31->setProductDescription('Ce steak Ribeye Prime possède un excellent persillage qui rends la pièce tendre, sucrée et savoureuse.');
        $product31->setProductPicture('product31.jpg');
        $product31->setPrice(86.66);
        $product31->setStock(15);
        $product31->setSlug('Noix-d-Entrecote-USDA-Prime-Black-Angus-1KG');
        $product31->setCategory($category7);
        $product31->setShop($shop6);
        $product31->setProvince($province1);
        $manager->persist($product31);

        $product32 = new Product();
        $product32->setProductName('Paupiette de Veau bio 130G x7');
        $product32->setProductDescription('Faites revenir les paupiettes dans une poêle, mettez deux cuillères d\'huile en y ajoutant des champignons et des oignons émincés et puis laissez mijoter 30 minutes à feu doux.');
        $product32->setProductPicture('product32.jpg');
        $product32->setPrice(32.80);
        $product32->setStock(30);
        $product32->setSlug('Paupiette-de-Veau-bio-130G-x7');
        $product32->setCategory($category7);
        $product32->setShop($shop6);
        $product32->setProvince($province1);
        $manager->persist($product32);

        $product33 = new Product();
        $product33->setProductName('Travers de porc frais 1KG');
        $product33->setProductDescription('Travers de porc à griller au barbecue un morceau simple que nous apprécions tous à la maison!');
        $product33->setProductPicture('product33.jpg');
        $product33->setPrice(19.88);
        $product33->setStock(35);
        $product33->setSlug('Travers-de-porc-frais-1KG');
        $product33->setCategory($category7);
        $product33->setShop($shop6);
        $product33->setProvince($province1);
        $manager->persist($product33);

        $product34 = new Product();
        $product34->setProductName('Bourguignon Boeuf de Charolais 1KG');
        $product34->setProductDescription('Morceau de boeuf découpé pour vos recettes de boeuf à mijoter.');
        $product34->setProductPicture('product34.jpg');
        $product34->setPrice(16.82);
        $product34->setStock(10);
        $product34->setSlug('Bourguignon-Boeuf-de-Charolais-1KG');
        $product34->setCategory($category7);
        $product34->setShop($shop6);
        $product34->setProvince($province1);
        $manager->persist($product34);

        $product35 = new Product();
        $product35->setProductName('Colin entier vide Piece de 2KG');
        $product35->setProductDescription('Facile à préparer et délicieux, le colin, aussi appelé merlu, est un poisson très apprécié pour le peu d\'arêtes qu\'il contient.');
        $product35->setProductPicture('product35.jpg');
        $product35->setPrice(29.99);
        $product35->setStock(8);
        $product35->setSlug('Colin-entier-vide-Piece-de-2KG');
        $product35->setCategory($category6);
        $product35->setShop($shop7);
        $product35->setProvince($province1);
        $manager->persist($product35);

        $product36 = new Product();
        $product36->setProductName('Noix de Saint-Jacques Bretonnes 1KG');
        $product36->setProductDescription('Noix de coquilles Saint-Jacques Bretonnes, de la baie de St Brieuc, préparées le matin de l\'expédition pour une fraîcheur remarquable. ');
        $product36->setProductPicture('product36.jpg');
        $product36->setPrice(65);
        $product36->setStock(10);
        $product36->setSlug('Noix-de-Saint-Jacques-Bretonnes-1KG');
        $product36->setCategory($category6);
        $product36->setShop($shop7);
        $product36->setProvince($province1);
        $manager->persist($product36);

        $product37 = new Product();
        $product37->setProductName('Crevettes roses Barquette de 1KG');
        $product37->setProductDescription('La crevette rose c\'est la star de l\'apéritif et des entrées faciles et délicieuses !');
        $product37->setProductPicture('product37.jpg');
        $product37->setPrice(21.9);
        $product37->setStock(12);
        $product37->setSlug('Crevettes-roses-Barquette-de-1KG');
        $product37->setCategory($category6);
        $product37->setShop($shop7);
        $product37->setProvince($province1);
        $manager->persist($product37);

        $product38 = new Product();
        $product38->setProductName('Congre entier 3KG');
        $product38->setProductDescription('Le congre commun (Conger conger) offre une chair blanche et ferme qui attise la curiosité des amateurs des bonnes saveurs !');
        $product38->setProductPicture('product38.jpg');
        $product38->setPrice(26.9);
        $product38->setStock(15);
        $product38->setSlug('Congre-entier-3KG');
        $product38->setCategory($category6);
        $product38->setShop($shop7);
        $product38->setProvince($province1);
        $manager->persist($product38);

        $product39 = new Product();
        $product39->setProductName('Homard vivant Piece de 900GR');
        $product39->setProductDescription('Faites-vous plaisir avec un magnifique Homard Breton vivant de 900g, le bleu de Bretagne, c\'est la garantie de déguster un produit au goût exceptionnel 100% naturel et peu calorique. Emballé dans des algues fraîches pour le transport, il arrivera vivant à bon port !');
        $product39->setProductPicture('product39.jpg');
        $product39->setPrice(104.99);
        $product39->setStock(3);
        $product39->setSlug('Homard-vivant-Piece-de-900GR');
        $product39->setCategory($category6);
        $product39->setShop($shop7);
        $product39->setProvince($province1);
        $manager->persist($product39);


        //ProductFactory::new()->createMany(100);
        
        for($i=0; $i<100; $i++){

            $id = 'product' . rand(1, 39);

            CommentFactory::new()->create([
               'product' => $$id
            ]);
        }

        //CommentFactory::new()->createMany(400);

        $manager->flush();
    }
}
