-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 05:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glasnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `korisnicko_ime` varchar(32) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'zoa', 'božić', 'zbozic', '$2y$10$JmK3jbifCbSoSsDsCd35eu6HFp484QDOygVlJAtpRxukRPgd2WIp.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `datum` varchar(32) NOT NULL,
  `naslov` varchar(64) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(64) NOT NULL,
  `kategorija` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '21.06.2026.', 'Mercedes povukao zahtjev za ponovno razmatranje rezultata na VN ', 'Situacija se smiruje nakon kontroverznog fijaska s kaznama na zadnjoj utrci', 'Mercedesova F1 momčad ranije je izrazila namjeru žaliti se na rezultate Velike nagrade Monaka, zbog kazni koje je na toj utrci dobio George Russell, ali je u međuvremenu odustala od tog postupka.\r\n\r\nZavrzlama koja je nastala tijekom utrke u Monte Carlu, kad je nekolicina vozača kažnjena zbog prebze vožnje u boksu, nikako da se do kraja raspetlja. Nakon utrke ispostavilo se da su kazne bile neopravdane i da je do njih dovela greška u procesu mjerenja, što je samo po sebi neprihvatljivo za razinu Formule 1.\r\n\r\nOnda je još Alpine dobio uspio kroz žalbeni postupak poništiti kazne koje je dobio Pierre Gasly te je francuskom vozaču vraćeno treće mjesto, dok su ostali uključeni timovi poludjeli zbog takve odluke jer su njihovi vozači, za razliku od Gaslyja, odrađivali kazne još za vrijeme utrke.\r\n\r\nJedan od tih vozača bio je George Russell. On je na kraju ostao bez bodova zbog dobivene kazne, a Mercedes je izrazio namjeru pokrenuti postupak revizije. FIA je čak i odobrila postupak te se u subotu trebalo održati prvo saslušanje na kojem bi Mercedes imao pravo prezentirati eventualne nove dokaze, ali na kraju od svega neće biti ništa jer su čelnici momčadi odustali.\r\n\r\n    “Suci su obaviješteni od strane Mercedes-AMG PETRONAS F1 tima da povlače zahtjev za ponovno razmatranje u vezi s odlukama sudaca na Velikoj nagradi Monaka 2026. godine, a koje se odnose na kršenje članka B1.6.3a FIA-inih F1 propisa za bolid broj 63”, napisali su suci FIA-e.\r\n\r\nBez obzira na Mercedesovo povlačenje u ovom slučaju, sapunica nije gotova jer su McLaren i Red Bull pokrenuli žalbeni postupak u vezi odluke sudaca o vraćanju Gaslyja na treću poziciju.', 'mercedes_auto_6_5ddf7d8f-c5fa-45e8-bf63-5bbdfb66eb1f.webp', 'sport', 0),
(2, '21.06.2026.', 'Luka Modrić protiv Paname ulazi u povijest', 'Legenda naše reprezentacije odrađuje svoj 200. nastup', 'Kapetan hrvatske nogometne reprezentacija Luka Modrić u susretu protiv Paname upisat će 200. nastup u dresu Vatrenih te tako postati tek četvrti nogometaš u \"klubu 200\".\r\n\r\nDo sada su samo tri igrača stigla do tog nevjerojatnog broja. Cristiano Ronaldo upisao je 229 nastupa u dresu portugalske reprezentacije, na drugom mjestu je Kuvajćanin Bader Al-Mutawa s 202 nastupa, Argentinac Lionel Messi nedavno je protiv Alžira ušao u \"klub 200\".\r\n\r\n\r\nNevjerojatan je to pothvat hrvatskog kapetana kojem je ovo peto svjetsko prvenstvo, a nastupio je i na pet europskih.\r\n\r\n\r\n\"Put je bio sjajan, nisam mogao ni sanjati da ću biti na pet SP-a. Kada se vratim na početke, bio sam dečko koji je imao velike snove. Sanjao sam o jednom nastupu, a uskoro ću imati 200. Svako prvenstvo činilo me boljim, rastao sam kao igrač i kao osoba, sa svim izbornicima i suigračima,\" kazao je nedavno na konferenciji za novinare u Dallasu.\r\n\r\nModrić je za Hrvatsku debitirao u ožujku 2006. u pobjedi (3-2) nad Argentinom, a prvi pogodak zabio je 16. kolovoza 2006. u Livornu u pobjedi 2-0 protiv tada aktualnih svjetskih prvaka Talijana.\r\n\r\n\r\nReprezentaciju je predvodio do srebra na Svjetskom prvenstvu 2018. u Rusiji te bronce četiri godine poslije u Kataru, a ima i srebro iz Lige nacija 2023. U hrvatskom dresu zabio je 29 golova, posljednji u zadnjem pripremnom susretu protiv Slovenije uoči puta u SAD.\r\n\r\n\r\n\"Stvarno nevjerojatan broj, ne zna čovjek što bi rekao, to je zaista čudesna priča. Hvala, kapetane, hvala, Luka,\" poručio je Andrej Kramarić.\r\n\r\n\r\n\"Teško je doći na ovu razinu, a najteže ostati. Onda znate koliko je Luka poseban kada je skupio 200 nastupa. Možemo mu se diviti i skinuti kapu,\" dodao je Petar Sučić.\r\n\r\n\r\n\"Možemo se svi samo diviti, svi znamo kakav je igrač i čovjek. Svaka mu čast,\" poručio je Josip Šutalo.', 'mrodic.webp', 'sport', 0),
(3, '21.06.2026.', '\"Zlica: Zauvijek\" od sada i na streamingu', 'Svjetski poznat nastavak hit filma dolazi i u vaše domove', 'Od 20. lipnja na ShyShowtime stiže film \"Zlica: Zauvijek\", nastavak globalnog fenomena \"Zlica\" Johna M. Chua s Arianom Grande i Cynthiom Erivo u glavnim ulogama\r\n\r\nVratite se u Smaragdni grad i ponovno uronite u čarobni svijet Oza uz film Zlica: Zauvijek, dostupan ekskluzivno za streaming na SkyShowtimeu od 20. lipnja. Zlica: Zauvijek predstavlja epski završetak globalnog kulturnog fenomena Zlica, koji je već sada dostupan za streaming na SkyShowtimeu.\r\n\r\nZavršno poglavlje dvodijelne filmske adaptacije slavnog mjuzikla počinje s Elphabom i Glindom koje su se udaljile jedna od druge te se moraju suočiti s posljedicama svojih izbora. Elphaba (Cynthia Erivo), sada demonizirana kao Zla vještica Zapada, živi u egzilu i nastavlja svoju borbu da raskrinka Čarobnjaka. U međuvremenu, Glinda (Ariana Grande) je postala glamurozan simbol dobrote i uživa u svim blagodatima slave i popularnosti. No, kada u njihove živote uđe djevojka iz Kansasa, Elphaba i Glinda moraju se ponovno ujediniti i doista upoznati jedna drugu – kako bi promijenile sebe i čitavu zemlju Oz. Dovedite avanturu kući i pripremite se da vas promijeni...zauvijek.\r\n\r\nFilm se temelji na kazališnom mjuziklu koji je obilježio mnoge generacije s glazbom i stihovima legendarnog skladatelja i tekstopisca Stephena Schwartza, dobitnika nagrada Grammy® i Oscar®, te na knjizi Winnie Holzman, nastaloj prema bestseleru Gregoryja Maguirea.\r\n\r\nRedatelj filma je priznati filmaš Jon M. Chu, a uz spektakularnu glumačku postavu, film Zlica: Zauvijek predvode zvijezde nominirane za Oscara Cynthia Erivo i Ariana Grande. U filmu također glume dobitnik nagrade Critics’ Choice® i nominirani za Emmy® Jonathan Bailey (Jurski svijet: Preporod, Bridgerton), dobitnik Emmyja Jeff Goldblum (Jurski park, Dan nezavisnosti), dobitnica Oscara i Zlatnog globusa® Michelle Yeoh (Sve u isto vrijeme, Suludo bogati Azijci), nominirani za nagradu Screen Actors Guild® Ethan Slater (brodvejski mjuzikl Spužva Bob Skockani, The Man Behind the Camera), Bowen Yang (Saturday Night Live, Nije li romantično?) i Marissa Bode. Producenti filma su dobitnik nagrada Tony® i Emmy Marc Platt te višestruki dobitnik nagrade Tony David Stone. Stephen Schwartz, David Nicksay, Jared LeBoff, Winnie Holzman i Dana Fox izvršni su producenti.\r\n\r\nZlica: Zauvijek pridružuje se rastućoj biblioteci blockbusterskih filmskih hitova među kojima su Downton Abbey: Veliko finale, Kako izdresirati zmaja, Jurski svijet: Preporod i Zlica.', 'Wicked_For_Good_Reviews1.webp', 'kultura', 0),
(4, '21.06.2026.', 'Arhivirana vijest (test arhive)', 'Ova vijest ima arhiva=1 pa se ne prikazuje na naslovnici.', 'Ova vijest postoji u bazi, ali se ne prikazuje na index.php niti kategorija.php jer joj je arhiva postavljena na 1.', 'kultura-placeholder.jpg', 'kultura', 1),
(5, '21.06.2026.', 'Narančaste mačke posvuda u gradu - zašto?', 'Dolazi li vrijeme kad će većina uličnih mačaka biti narančasto?', 'Jučer navečer (7.5.2026.) u našem lijepom Zagrebu ugledana je nova mačka imena Bubi. Bubi je narančasta mačka mekanog krzna koja se šetala Ilicom u kasnim noćnim satima. To je bila čak deseta narančasta mačka viđena u gradu samo na taj dan. \r\n\r\nOvo je potaklo pitanje: Jesu li narančaste mačke nova lica ulice?\r\nNekoć su to bile mješane smeđe mačke, no kako raste popularnost narančastih mačaka, tako raste i njihova populacija ne samo u domovima i srcima ljudi, već i na gradskim ulicama.\r\n\r\nO ovome smo upitali par stručnjaka:\r\n\"Imaju pola moždane stanice al zato imaju dvostruko ljubavi,\" rekao je jedan mačkolog, dok je drugi komentirao, \"Obožavam ih, jako su šašave i jako slatke.\" (Citati su prevedeni s engleskog)', 'df2K7EnQLce3t3CBUEqNGe.jpg', 'kultura', 0),
(6, '21.06.2026.', 'Oko tri milijuna ljudi na pobjedničkoj paradi New York Knicksa', 'Ludo slavlje zbog prvog naslova prvaka u 53 godine', 'Procjenjuje se kako se tri milijuna oduševljenih navijača New York Knicksa okupilo na pobjedničkoj paradi svoje omiljene košarkaške momčadi u četvrtak kako bi pozdravilo igrače koji su prije pet dana osvojili naslov NBA prvaka, prvi za taj klub nakon čak 53 godine.\r\n\r\nČak i prije osvita novog dana u New Yorku duž Broadwaya počeli su se okupljati navijači kako bi uhvatili što bolju poziciju.\r\n\r\nPolicija je objavila kako su sva predviđena mjesta za promatranje parade bila puna tri sata prije početka, a novi gradonačelnik Zohran Mamdani kazao je kako bi ovo mogla biti najveća parada u povijesti grada.\r\n\r\nU 10.32 sati po lokalnom vremenu igrači Knicksa krenuli su na svoj 1.1 kilometara dug put od južnog Manhattana do gradske vijećnice gdje im je Mamdani uručio simbolične ključeve grada.\r\n\r\nGradska vijećnica ovim je povodom bila osvijetljena u plavo i narančasto, boje Knicksa koje su krasile i mnoge druge znamenite zgrade u gradu tijekom pobjedničkog marša momčadi kroz ovogodišnje doigravanje.', '6a340cce4850c.image.jpg', 'sport', 0),
(7, '21.06.2026.', 'Preminula Slavenka Drakulić', 'Prisjećamo se velike spisateljice', 'U 77. godini preminula je Slavenka Drakulić, jedna od najpoznatijih suvremenih hrvatskih književnica u svijetu, autorica i novinarka koja je najbolje opisala naš burni tranzicijski svijet i čija su nam publicistička djela pomagala shvatiti što nam se događalo posljednjih četrdeset godina.\r\n\r\nU utorak, 23.6., na Prvom programu HTV-a u 22:25 - u sjećanje na veliku spisateljicu emitirat će se Razgovor s razlogom u kojem je gostovala Slavenka Drakulić.\r\n\r\nRođena je 1949. u Rijeci i bila jedna od najprevođenijih i međunarodno najpoznatijih hrvatskih autorica. Pisala je o položaju žena, komunizmu, ratovima na prostoru bivše Jugoslavije i društvenim promjenama u Europi.\r\n\r\nMeđu njezinim najpoznatijim djelima su \"Kako smo preživjeli komunizam i čak se smijali\", \"Balkan Express\", \"Kao da me nema\", \"Oni ne bi ni mrava zgazili\", \"Frida ili o boli\" i \"Mileva Einstein, teorija tuge\".\r\n\r\nNjezine su knjige prevedene na brojne jezike, a živjela je i radila u Hrvatskoj i Švedskoj.', 'image.webp', 'kultura', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
