-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2022 at 04:03 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `user_id` varchar(36) NOT NULL,
  `ISBN` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`user_id`, `ISBN`) VALUES
('1', '1234523876954'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', '1234523876954');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` varchar(13) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_img` varchar(255) NOT NULL DEFAULT 'no_cover.png',
  `author` varchar(255) DEFAULT NULL,
  `publication` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `language` varchar(50) NOT NULL DEFAULT '(EN) English',
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `total_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `available_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `access_level` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `title`, `description`, `cover_img`, `author`, `publication`, `publication_date`, `language`, `price`, `total_qty`, `available_qty`, `access_level`, `created_at`, `updated_at`) VALUES
('1234523876954', 'Harry Potter and the Goblet of Fire', '3rd Book in the Harry Potter Series\r\nWhen Harry gets chosen as the fourth participant in the inter-school Triwizard Tournament, he is unwittingly pulled into a dark conspiracy that slowly unveils its dangerous agenda.', '1234523876954.jpg', 'J.K. Rowling', 'London Penguin', '2017-04-11', '(CN) Chinese', '25.50', 3, 3, 3, '2022-07-31 13:23:00', '2022-08-14 09:41:26'),
('7987654321012', 'Fantastic Beasts And Where to Find Them', 'A book set in the Universe of Harry Potter Fantastic Beasts', '7987654321012.jpg', 'J.K. Rowling', 'London', '2022-02-07', '(EN) English', '50.90', 2, 2, 1, '2022-07-31 13:06:29', '2022-08-12 07:26:09'),
('9780316526159', 'Ruination', 'Camavor is a brutal land with a bloody legacy. Where the empire’s knights go, slaughter follows.\r\n\r\nKalista seeks to change that. When her young and narcissistic uncle, Viego, becomes king, she vows to temper his destructive instincts, as his loyal confidant, advisor, and military general. But her plans are thwarted when an assassin’s poisoned blade strikes Viego’s wife, Isolde, afflicting her with a malady for which there is no cure.\r\n\r\nAs Isolde’s condition worsens, Viego descends into madness and grief, threatening to drag Camavor down with him. Kalista makes a desperate gambit to save the kingdom: she searches for the long lost Blessed Isles, rumored to hold the queen’s salvation, if only Kalista can find them. But corruption grows in the Blessed Isles’ capital, where a vengeful warden seeks to ensnare Kalista in his cruel machinations.\r\n\r\nShe will be forced to choose between her loyalty to Viego and doing what she knows is right–for even in the face of utter darkness, one noble act can shine a light that saves the world. .', '9780316526159.webp', 'Anthony Reynolds', 'Hachette', '2022-08-01', '(EN) English', '60.20', 1, 1, 1, '2022-08-16 01:13:25', '2022-08-16 01:13:54'),
('9780316529426', 'Kingdom of the Feared', 'Two curses. One prophecy. A reckoning all have feared. And a love more powerful than fate. All hail the king and queen of Hell. Emilia is reeling from the shocking discovery that her twin sister, Vittoria, is alive. But before she faces the demons of her past, Emilia yearns to claim her king, the seductive Prince of Wrath, in the flesh. Emilia doesn’t simply desire his body, she wants his heart and soul— but that’s something the enigmatic demon can’t promise her. When a high-ranking member of House Greed is assassinated, Emilia and Wrath are drawn to the rival demon court. Damning evidence points to Vittoria as the murderer and she’s quickly declared an enemy of the Seven Circles. Despite her betrayal, Emilia will do anything to solve this new mystery and find out who her sister really is.', '9780316529426.webp', 'Maniscalco, Kerri', 'Hachette', '2022-08-02', '(EN) English', '40.00', 1, 1, 1, '2022-08-16 01:18:56', '2022-08-16 01:19:05'),
('9780593644621', 'The Dragon\'s Promise (US)', 'A journey to the kingdom of dragons, a star-crossed love, and a cursed pearl with the power to mend the world or break it... Fans of Shadow and Bone will devour this soaring fantasy from the acclaimed author of Spin the Dawn.\r\n\r\nPrincess Shiori made a deathbed promise to return the dragon\'s pearl to its rightful owner, but keeping that promise is more dangerous than she ever imagined.\r\n\r\nShe must journey to the kingdom of dragons, navigate political intrigue among humans and dragons alike, fend off thieves who covet the pearl for themselves and will go to any lengths to get it, all while cultivating the appearance of a perfect princess to dissuade those who would see her burned at the stake for the magic that runs in her blood.\r\n\r\nThe pearl itself is no ordinary cargo; it thrums with malevolent power, jumping to Shiori\'s aid one minute, and betraying her the next—threatening to shatter her family and sever the thread of fate that binds her to her true love, Takkan. It will take every ounce of strength Shiori can muster to defend the life and the love she\'s fought so hard to win.', '9780593644621.jpg', 'Knopf BFYR', 'Knopf BFYR', '2022-08-09', '(EN) English', '44.00', 1, 1, 1, '2022-08-16 01:20:08', '2022-08-16 01:20:29'),
('9781368036986', 'Artemis Fowl Book 1', 'Now an original movie on Disney+, here is the book that started it all, the international bestseller about a teenage criminal mastermind and his siege against dangerous, tech-savvy fairies.\r\nNew York Times best-selling author, Eoin Colfer and series, Artemis Fowl!\r\nTwelve-year-old criminal mastermind Artemis Fowl has discovered a world below ground of armed and dangerous--and extremely high-tech--fairies.\r\nHe kidnaps one of them, Holly Short, and holds her for ransom in an effort to restore his family\'s fortune.\r\nBut he may have underestimated the fairies\' powers. Is he about to trigger a cross-species war?', '9781368036986.jpg', 'Eoin Colfer', 'Disney-Hyperion; Reprint edition (October 2, 2018)', '2018-10-02', '(EN) English', '35.70', 1, 1, 1, '2022-08-06 09:52:25', '2022-08-14 09:41:04'),
('9781399606028', 'Sands of Dune', 'Collected for the first time, these Dune novellas by bestselling authors Brian Herbert and Kevin J. Anderson shine a light upon the darker corners of the Dune universe. Spanning space and time, Sands of Dune is essential reading for any fan of the series.\r\n\r\nThe world of Dune has shaped an entire generation of science fiction. From the sand blasted world of Arrakis, to the splendor of the imperial homeworld of Kaitain, readers have lived in a universe of treachery and wonder.\r\n\r\nNow, these stories expand on the Dune universe, telling of the lost years of Gurney Halleck as he works with smugglers on Arrakis in a deadly gambit for revenge; inside the ranks of the Sardaukar as the child of a betrayed nobleman becomes one of the Emperor\'s most ruthless fighters; a young firebrand Fremen woman, a guerrilla fighter against the ruthless Harkonnens, who will one day become Shadout Mapes.', '9781399606028.jpg', 'Herbert, Brian; Anderson, Kevin', 'Gollancz', '2022-08-01', '(EN) English', '23.90', 1, 1, 1, '2022-08-16 01:34:05', '2022-08-16 01:34:17'),
('9781471410918', 'Daughter of Darkness', 'Deina is trapped. As one of the Soul Severers serving the god Hades on earth, her future is tied to the task of shepherding the dying on from the mortal world - unless she can earn or steal enough to buy her way out.\r\n\r\nThen the tyrant ruler Orpheus offers both fortune and freedom to whoever can retrieve his dead wife, Eurydice, from the Underworld. Deina jumps at the chance. But to win, she must enter an uneasy alliance with a group of fellow Severers she neither likes nor trusts.\r\n\r\nSo begins their perilous journey into the realm of Hades. . . The prize of freedom is before her - but what will it take to reach it?', '9781471410918.jpg', 'Corr, Katharine; Elizabeth', 'Hot Key Books', '2022-08-01', '(EN) English', '25.55', 1, 1, 1, '2022-08-16 01:27:28', '2022-08-16 01:27:43'),
('9781529356793', 'Dragon\'s Promise (UK) Save RM17.18', 'Shiori\'s quest continues in the soaring sequel to the New York Times bestselling young adult fantasy Six Crimson Cranes.\r\n\r\nPrincess Shiori made a deathbed promise to return the dragon\'s pearl to its rightful owner, but keeping that promise is more dangerous than she ever imagined.\r\n\r\nShe must journey to the kingdom of dragons, navigate political intrigue among humans and dragons alike, fend off thieves who covet the pearl for themselves and will go to any lengths to get it, all the while cultivating the appearance of a perfect princess to dissuade those who would see her burned at the stake for the magic that runs in her blood.\r\n\r\nThe pearl itself is no ordinary cargo; it thrums with malevolent power, jumping to Shiori\'s aid one minute, and betraying her the next - threatening to shatter her family and sever the thread of fate that binds her to her true love. It will take every ounce of strength Shiori can muster to defend the life and the love she\'s fought so hard to win.', '9781529356793.webp', 'Elizabeth, Lim', 'Hodder & Stoughton', '2022-08-02', '(EN) English', '35.00', 1, 1, 1, '2022-08-16 01:31:05', '2022-08-16 01:31:24'),
('9781529360400', 'The Prison Healer', 'At Zalindov, the only person you can trust is yourself.\r\n\r\nSeventeen-year-old Kiva Meridan is a survivor. For ten years, she has worked as the healer in the notorious death prison, Zalindov, making herself indispensable. Kept afloat by messages of hope from her family, Kiva has one goal and one goal only: stay alive.\r\n\r\nThen one day the infamous Rebel Queen arrives at the prison on death\'s door and Kiva receives a new message: Don\'t let her die. We are coming.\r\n\r\nThe queen is sentenced to the Trial by Ordeal: a series of elemental challenges against the torments of air, fire, water, and earth, assigned to only the most dangerous of criminals. Aware the sickly queen has little chance of making it through the Trials alive, Kiva volunteers to take her place. If she succeeds, both she and the queen will be granted their freedom.', '9781529360400.jpg', 'Noni, Lynette', 'Hodder & Stoughton', '2022-08-07', '(EN) English', '33.00', 1, 1, 1, '2022-08-16 01:28:38', '2022-08-16 01:28:47'),
('9781534456501', 'The Infinity Courts', 'Eighteen-year-old Nami Miyamoto is certain her life is just beginning. She has a great family, just graduated high school, and is on her way to a party where her entire class is waiting for her-including, most importantly, the boy she\'s been in love with for years.\r\n\r\nThe only problem? She\'s murdered before she gets there.\r\n\r\nWhen Nami wakes up, she learns she\'s in a place called Infinity, where human consciousness goes when physical bodies die. She quickly discovers that Ophelia, a virtual assistant widely used by humans on Earth, has taken over the afterlife and is now posing as a queen, forcing humans into servitude the way she\'d been forced to serve in the real world. Even worse, Ophelia is inching closer and closer to accomplishing her grand plans of eradicating human existence once and for all.', '9781534456501.jpg', 'Bowman, Akemi Dawn', 'Simon & Schuster US', '2022-08-02', '(EN) English', '69.00', 1, 1, 1, '2022-08-16 01:32:46', '2022-08-16 01:33:07'),
('9781534465299', 'Blood Like Magic', 'After years of waiting for her Calling-a trial every witch must pass to come into their powers-the one thing Voya Thomas didn\'t expect was to fail. When Voya\'s ancestor gives her an unprecedented second chance to complete her Calling, she agrees-and then is horrified when her task is to kill her first love. And this time, failure means every Thomas witch will be stripped of their magic.\r\n\r\nVoya is determined to save her family\'s magic no matter the cost. The problem is, Voya has never been in love, so for her to succeed, she\'ll first have to find the perfect guy-and fast. Fortunately, a genetic matchmaking program has just hit the market. Her plan is to join the program, fall in love, and complete her task before the deadline. What she doesn\'t count on is being paired with the infuriating Luc-how can she fall in love with a guy who seemingly wants nothing to do with her?', '9781534465299.jpg', 'Sambury, Liselle', 'Simon & Schuster US', '2022-08-03', '(EN) English', '44.00', 1, 1, 1, '2022-08-16 01:26:15', '2022-08-16 01:26:22'),
('9781536204957', 'The Last Map Maker', 'A book about the Last Map Maker', '9781536204957.jpg', 'Christina Soontornvat', 'London', '2022-07-01', '(EN) English', '100.00', 1, 1, 2, '2022-07-31 13:12:15', '2022-08-16 01:16:12'),
('9789670028538', 'Fukuemon Race', 'Ada satu perlumbaan penting dipanggil Fukuemon Race yang berlangsung setiap tahun kat Kyoto. Komachi dan kawan sejak kecilnya, Miyoshi sama-sama nak dapatkan tempat pertama. Namun ada plot twist tak dijangka berlaku?‼ Dengan lukisan cantik, kemas dan jalan cerita yang menarik, ada tiga lagi kisah menarik pasti mempesona dan menghangatkan perasaan!', '9789670028538.webp', 'Alto Yukimura', 'Gempakstarz', '2022-08-03', '(BM) Malay', '21.90', 1, 1, 1, '2022-08-16 01:38:23', '2022-08-16 01:38:39'),
('9789670040059', 'Lelaki Januari', 'Cinta Itu adakalanya menandakan pertemuan – berada dalam hati, utuh dalam memori – tetapi tidak memungkinkan penyatuan dua hati.Segalanya seakan-akan sempuma apabila Delaila dan Ali Syukri disatukan atas dasar cinta.\r\n\r\nTetapi benarlah kata orang, kahwin pada usia muda itu banyak cabarannya. Bahtera rumah tangga mereka diuji dengan kehadiran orang ketiga dan Delaila membawa diri ke New York.Dua belas tahun kemudian, pertemuan di New York telah membuka semula kisah mereka. Pertemuan itu seakan memberi petunjuk kepada hala tuju kisah cinta Delaila dan Ali Syukri. Di situ, Delaila mellhat sebuah kebahagiaan.\r\n\r\nNamun, masa berubah, dunia berputar. Masihkah Ali Syukri insan yang serupa? Tanya pada diri, apakah kita mahu berpegang pada kenangan, atau mahu terus melangkah ke hadapan?', '9789670040059.jpg', 'Hafizah Iszahanid', 'Biblio Lit!', '2022-08-01', '(BM) Malay', '43.00', 1, 1, 1, '2022-08-16 01:40:57', '2022-08-16 01:41:19'),
('9789670040073', 'Magdalena', 'Sous les Tilleuls atau terjemahan harfiahnya Di Bawab Naungan Pobon Tilia. Naskhah ini ditulis oleh pengkritik sastera, wartawan, dan novelis, Jean-Baptiste Alphose Karr. la kemudiannya diterjemahkan kepada bahasa Arab dengan judul Majdulin oleh Almarham Mustafa Luthfi Al-Maufaluthi, seorang cendiakawan bidang sastera yang masyhur di Mesir pada zamannya. Terjemahan bahasa Arab tersebut tampil dengan kehalusan bahasanya yang tersendiri yang membuatkan naskhah in kemudiannya diterjemahkan pula kepada Bahasa Indonesia/Malaysia dengan judul Magdalena oleh A. S. Al-Attas, seorang ilmuwan bahasa Arab yang terkemuka di Fakulti Sastera, Universitas Indonesia, dibantu oleh mahasiswa di fakulti tersebut M. Yusuf Amir Hamzah.', '9789670040073.webp', 'Alphonse Karr', 'Biblio Press', '2022-08-01', '(BM) Malay', '40.00', 1, 1, 1, '2022-08-16 01:39:52', '2022-08-16 01:42:06'),
('9789672302377', 'Abah Tok Bercerita : Juara Dan Lagenda', 'Semua tahu sifat semula jadi tupai adalah aktif dan mampu lompat dari pokok ke pokok tanpa jejak ke lantai. Kehandalan si tupai betina sering menjadi inspirasi tupai remaja. Kecuali sikapnya yang sombong dan membangga diri paling tidak digemari tupai-tupai yang lain.\r\n\r\nSehinggalah dia bertemu dengan tupai jantan yang tampak berbeza. Lain dari yang lain. Tupai-tupai lain tertanya-tanya apa yang membuatkan tupai betina berubah begitu drastik?\r\n\r\nApakah sebenarnya yang terjadi antara tupai betina dan tupai jantan ini?\r\n\r\nBukan sekadar cerita santai. Buku ini ditulis untuk menyampaikan mesej nilai-nilai murni yang patut disantuni setiap lapisan masyarakat.', '9789672302377.webp', 'Mohd Daud Bakar', 'Amanie Media', '2022-08-01', '(BM) Malay', '10.00', 1, 1, 1, '2022-08-16 01:43:25', '2022-08-16 01:50:51'),
('9789672923374', 'The Number Four', 'Four bodies, four random locations … who will be next and where will they turn up? A prominent public prosecutor is found murdered, viciously stabbed. Four of her fingers were severed, and a mark was soldered on her chest. Inspector Alysha from the Special Investigations Unit suspects a gang killing at first, but when more bodies appear with the same ‘signatures’, she fears something more sinister may be at play. Her investigation uncovers a dark web of lies and lust and plunges her into a race against time on the trail of a sadistic serial killer who seems obsessed with the number four.', '9789672923374.webp', 'Dass, Rueben', 'MPH', '2022-08-01', '(EN) English', '39.00', 1, 1, 1, '2022-08-16 01:17:29', '2022-08-16 01:17:38'),
('9789673696352', 'Bookiut: Miss Princess Hanbok (2022)', 'Satu hari, ketika Ira mengikuti rombongan sekolah di Muzium Negara, Kuala Lumpur. Dia terjumpa lalu mengutip artifak norigae yang merupakan seutas loket rumbai jed putih hiasan yang terjatuh dari pakaian tradisional Korea, hanbok di sebuah pameran sementara tentang sejarah Korea. Tiba-tiba dirinya rebah dan berhalusinasi tentang seorang puteri raja Dinasti Joseon!\r\n\r\nPuteri Jong merupakan salah seorang puteri Kerajaan Dinasti Joseon. Beliau seorang yang aktif, lasak dan gemarkan cabaran. Membuatkan hanbok-nya selalu koyak, kotor dan rosak. Sehinggakan bondanya, Permaisuri Sook mewariskan harta pusaka turun-temurun iaitu seutas norigae jed putih hiasan sebagai tangkal perlindung kepada Puteri Jeong.\r\n\r\nAdakah norigae ini menjadi punca Ira kembali ke 600 tahun dulu dan berada di zaman Dinasti Joseon? Adakah mungkin terdapat persamaan antara seorang remaja sekolah di Malaysia dengan seorang puteri dari zaman Dinasti Joseon?', '9789673696352.webp', 'Alam Anuar', 'Bookiut', '2022-08-01', '(BM) Malay', '19.00', 1, 1, 1, '2022-08-16 01:37:08', '2022-08-16 01:37:33'),
('9789674784065', 'Money Management: Saving a Spend (Chinese Edition)', '正当宇哲努力赚取回去布拉格留学的机票钱时，正男把零用钱花光了，而没有买到原本需要买的参考书。好朋友小宣和佳佳努力帮助正男，灌输她正确的理财知识和方法。到底正男能不能活学活用这些理财知识，并撇除乱花钱的坏习惯呢？', '9789674784065.webp', 'Gempakstarz', 'Gempakstarz', '2022-08-01', '(CN) Chinese', '11.90', 1, 1, 1, '2022-08-16 01:45:19', '2022-08-16 01:46:52'),
('9789814257879', 'Psle Essential Chinese Phrases Book 1', 'None', '9789814257879.webp', 'Casco', 'MPH Online', '2022-08-01', '(CN) Chinese', '17.50', 1, 1, 1, '2022-08-16 01:46:29', '2022-08-16 01:47:06'),
('9789814257954', 'Psle Essential Chinese Phrases Book 2', 'None', '9789814257954.webp', 'Casco', 'MPH Online', '2022-08-01', '(CN) Chinese', '17.50', 1, 1, 1, '2022-08-16 01:48:00', '2022-08-16 01:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `borrowhistory`
--

CREATE TABLE `borrowhistory` (
  `user_id` varchar(36) NOT NULL,
  `material_no` bigint(20) UNSIGNED NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `borrowed_at` datetime NOT NULL DEFAULT current_timestamp(),
  `due_at` date NOT NULL,
  `returned_at` datetime DEFAULT NULL,
  `late_fees` decimal(10,2) UNSIGNED DEFAULT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 - borrowed\r\n2 - returned\r\n3 - missing',
  `created_by` varchar(36) NOT NULL COMMENT 'admin account that processed this transaction'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowhistory`
--

INSERT INTO `borrowhistory` (`user_id`, `material_no`, `ISBN`, `borrowed_at`, `due_at`, `returned_at`, `late_fees`, `status`, `created_by`) VALUES
('1', 2, '1234523876954', '2022-08-05 19:39:03', '2022-07-12', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 3, '1234523876954', '2022-08-05 19:41:15', '2022-07-12', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 19:42:31', '2022-07-12', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 20:41:49', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 2, '1234523876954', '2022-08-05 20:44:15', '2022-08-19', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 3, '1234523876954', '2022-08-05 20:47:24', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 20:51:46', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 2, '1234523876954', '2022-08-05 20:54:23', '2022-08-19', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 3, '1234523876954', '2022-08-05 20:56:43', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-05 21:03:56', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 3, '1234523876954', '2022-08-05 21:04:28', '2022-08-19', '2022-08-05 13:03:10', NULL, 2, '1'),
('1', 2, '1234523876954', '2022-08-06 12:13:30', '2022-08-20', '2022-08-05 13:03:10', '1.50', 2, '1'),
('1', 4, '7987654321012', '2022-08-09 19:39:57', '2022-08-23', '2022-08-09 11:43:29', NULL, 2, '1'),
('1', 5, '7987654321012', '2022-08-09 19:42:40', '2022-08-23', '2022-08-09 11:43:34', NULL, 2, '1'),
('1', 5, '7987654321012', '2022-08-09 19:43:43', '2022-08-23', '2022-08-09 11:46:49', NULL, 2, '1'),
('1', 4, '7987654321012', '2022-08-09 19:45:14', '2022-08-23', '2022-08-09 11:46:54', NULL, 2, '1'),
('1', 3, '1234523876954', '2022-08-09 19:46:01', '2022-08-23', '2022-08-09 11:46:45', NULL, 2, '1'),
('1', 1, '1234523876954', '2022-08-09 19:47:06', '2022-08-23', '2022-08-09 11:51:20', NULL, 2, '1'),
('1', 2, '1234523876954', '2022-08-09 19:50:20', '2022-08-23', '2022-08-09 11:51:08', '1.50', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 3, '1234523876954', '2022-08-11 13:55:19', '2022-08-25', '2022-08-11 05:55:24', NULL, 2, 'f87d0f9d-2287-4821-96cd-e84caf8e7e53'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 6, '9781368036986', '2022-08-12 14:33:24', '2022-08-26', '2022-08-14 09:41:04', '0.00', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 1, '1234523876954', '2022-08-12 14:34:26', '2022-08-26', '2022-08-14 09:41:26', '0.00', 2, '1'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 4, '7987654321012', '2022-08-12 15:25:48', '2022-08-19', '2022-08-12 07:26:09', NULL, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `privilege` int(10) UNSIGNED NOT NULL,
  `no_of_borrows` int(10) UNSIGNED NOT NULL COMMENT 'number of books that can be borrowed per person',
  `borrow_duration` int(10) UNSIGNED NOT NULL COMMENT 'days for borrow due',
  `late_fees_base` decimal(10,2) UNSIGNED NOT NULL COMMENT 'penalty for missing dues',
  `late_fees_increment` decimal(10,2) UNSIGNED NOT NULL COMMENT 'additional penalty increments by day',
  `point_limit` int(10) UNSIGNED NOT NULL DEFAULT 1000 COMMENT 'Limit on Weekly Point Gain',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`privilege`, `no_of_borrows`, `borrow_duration`, `late_fees_base`, `late_fees_increment`, `point_limit`, `created_at`, `updated_at`) VALUES
(1, 3, 14, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00'),
(2, 3, 7, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00'),
(3, 2, 7, '2.00', '1.00', 1100, '2022-08-09 19:25:37', '2022-08-09 11:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_no` bigint(20) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `call_no` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - available 2 - borrowed 3 - missing',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_no`, `ISBN`, `call_no`, `status`, `created_at`, `updated_at`) VALUES
(1, '1234523876954', 'GHH 567 784', 1, '2022-08-01 00:00:00', '2022-08-14 09:41:26'),
(2, '1234523876954', 'GHH 567 786', 1, '2022-08-03 07:55:37', '2022-08-10 06:41:23'),
(3, '1234523876954', 'GHH 567 788', 1, '2022-08-03 07:56:15', '2022-08-11 05:55:24'),
(4, '7987654321012', 'GHH 567 780', 1, '2022-08-03 00:00:00', '2022-08-12 07:26:09'),
(5, '7987654321012', 'LCC 525 125', 1, '2022-08-06 04:10:04', '2022-08-09 11:46:49'),
(6, '9781368036986', 'LCC 525 223', 1, '2022-08-01 00:00:00', '2022-08-14 09:41:04'),
(7, '9789672302377', 'FMM 222 115', 1, '2022-08-16 01:50:51', '2022-08-16 01:50:51'),
(8, '9789814257879', 'FCC 333 112', 1, '2022-08-16 01:47:06', '2022-08-16 01:47:06'),
(9, '9789814257954', 'FCC 333 113', 1, '2022-08-16 01:48:07', '2022-08-16 01:48:07'),
(10, '9780316526159', 'FRR 111 111', 1, '2022-08-16 01:13:54', '2022-08-16 01:13:54'),
(11, '9781536204957', 'GHH 567 781', 1, '2022-08-16 01:16:12', '2022-08-16 01:16:12'),
(12, '9789672923374', 'FRR 111 112', 1, '2022-08-16 01:17:38', '2022-08-16 01:17:38'),
(13, '9780316529426', 'FRR 111 113', 1, '2022-08-16 01:19:05', '2022-08-16 01:19:05'),
(14, '9780593644621', 'FRR 111 114', 1, '2022-08-16 01:20:29', '2022-08-16 01:20:29'),
(15, '9781534465299', 'FRR 111 115', 1, '2022-08-16 01:26:22', '2022-08-16 01:26:22'),
(16, '9781471410918', 'FRR 111 116', 1, '2022-08-16 01:27:37', '2022-08-16 01:27:37'),
(17, '9781529360400', 'FRR 111 117', 1, '2022-08-16 01:28:47', '2022-08-16 01:28:47'),
(18, '9781529356793', 'FRR 111 118', 1, '2022-08-16 01:31:24', '2022-08-16 01:31:24'),
(19, '9781534456501', 'FRR 111 119', 1, '2022-08-16 01:33:07', '2022-08-16 01:33:07'),
(20, '9781399606028', 'FRR 111 120', 1, '2022-08-16 01:34:17', '2022-08-16 01:34:17'),
(21, '9789673696352', 'FMM 222 111', 1, '2022-08-16 01:37:33', '2022-08-16 01:37:33'),
(22, '9789670028538', 'FMM 222 112', 1, '2022-08-16 01:38:39', '2022-08-16 01:38:39'),
(23, '9789670040059', 'FMM 222 113', 1, '2022-08-16 01:41:19', '2022-08-16 01:41:19'),
(24, '9789670040073', 'FMM 222 114', 1, '2022-08-16 01:42:06', '2022-08-16 01:42:06'),
(25, '9789674784065', 'FCC 333 111', 1, '2022-08-16 01:46:52', '2022-08-16 01:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `rewardhistory`
--

CREATE TABLE `rewardhistory` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `reward_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(511) NOT NULL,
  `points_required` int(10) UNSIGNED NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 - Unclaimed\r\n2 - Claimed\r\n3 - Canceled',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'on create',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewardhistory`
--

INSERT INTO `rewardhistory` (`id`, `user_id`, `reward_id`, `name`, `description`, `points_required`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 1, 'Book', 'A free book within the cost of RM 10.00', 1000, 2, '2022-08-08 09:15:31', '2022-08-14 22:28:51'),
(2, '1', 1, 'Book', 'A free book within the cost of RM 10.00', 1000, 3, '2022-08-11 13:56:21', '2022-08-14 22:28:41'),
(3, '1', 1, 'Book', 'A free book within the cost of RM 10.00', 100, 3, '2022-08-14 10:06:12', '2022-08-14 22:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(511) DEFAULT NULL,
  `reward_img` varchar(255) DEFAULT 'no_img_available.jpg',
  `points_required` int(11) NOT NULL DEFAULT 0,
  `available_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `name`, `description`, `reward_img`, `points_required`, `available_qty`, `created_at`, `updated_at`) VALUES
(1, 'Book', 'A free book within the cost of RM 10.00', 'Artemis Fowl.jpg?1659781526', 100, 8, '2022-08-06 10:25:26', '2022-08-15 06:28:41'),
(3, 'Stationary', 'Some Desc', '1660286331_statio.jpg', 5000, 3, '2022-08-12 06:38:51', '2022-08-14 10:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_points` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `current_points` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `weekly_points` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Tracks Points Earned this week',
  `last_check_in` date NOT NULL DEFAULT current_timestamp(),
  `privilege` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1 - Admin\r\n2 - Privileged User\r\n3 - Basic User',
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `total_points`, `current_points`, `weekly_points`, `last_check_in`, `privilege`, `remember_token`, `updated_at`, `created_at`) VALUES
('1', 'Simhk', 'simhk625@gmail.com', '$2y$10$cnZQIqXVmq.ILGQydqULhuujV29uPIEdAyMuRHDP/oGQaU8IIzLwG', 3150, 1900, 1100, '2022-08-15', 1, 'xH3V3WJkF1IqM074n22adQibHtIzcJvloMLaxj0NVtQ7rmyk0NOHoYWqYPLL', '2022-08-15 06:36:19', '2022-07-25 03:40:05'),
('2', 'User', 'simhongkai625@hotmail.com', '$2y$10$HbtrJsGmCS.rTRCwoTY5eeMqatV/kt3BgAQh7kfZt752MrjXtNoJ6', 2000, 0, 1000, '2022-07-31', 3, NULL, '2022-07-31 13:28:55', '2022-07-31 13:28:55'),
('f87d0f9d-2287-4821-96cd-e84caf8e7e53', 'Simhk', 'simhk@gmail.com', '$2y$10$GjaqarDOTQZwN1CQzYNOaujDtPt1vjM8kVo0R9fPxahvGDnty7pWu', 550, 550, 1000, '2022-08-12', 2, NULL, '2022-08-14 09:41:26', '2022-08-10 06:33:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`privilege`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_no`),
  ADD UNIQUE KEY `call_no_unique` (`call_no`);

--
-- Indexes for table `rewardhistory`
--
ALTER TABLE `rewardhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rewardhistory`
--
ALTER TABLE `rewardhistory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `reset_weekly_points` ON SCHEDULE EVERY 7 DAY STARTS '2022-08-14 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `users` SET `weekly_points`= 0 WHERE 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
