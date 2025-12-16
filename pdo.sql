-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Paź 2021, 08:12
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `grupa 2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `book`
--

INSERT INTO `book` (`id`, `title`, `authors`, `number`) VALUES
(1, 'The Lord of the Rings', 'JRR Tolkien', 3),
(2, 'Pride and Prejudice', 'Jane Austen', 3),
(3, 'His Dark Materials', 'Philip Pullman', 3),
(4, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 3),
(5, 'Harry Potter and the Goblet of Fire', 'JK Rowling', 3),
(6, 'To Kill a Mockingbird', 'Harper Lee', 3),
(7, 'Winnie the Pooh', 'AA Milne', 3),
(8, 'Nineteen Eighty-Four', 'George Orwell', 3),
(9, 'The Lion', 'the Witch and the Wardrobe', 3),
(10, 'Jane Eyre', 'Charlotte Brontë', 3),
(11, 'Catch-22', 'Joseph Heller', 3),
(12, 'Wuthering Heights', 'Emily Brontë', 3),
(13, 'Birdsong', 'Sebastian Faulks', 3),
(14, 'Rebecca', 'Daphne du Maurier', 3),
(15, 'The Catcher in the Rye', 'JD Salinger', 3),
(16, 'The Wind in the Willows', 'Kenneth Grahame', 3),
(17, 'Great Expectations', 'Charles Dickens', 3),
(18, 'Little Women', 'Louisa May Alcott', 3),
(19, 'Captain Corelli\'s Mandolin', 'Louis de Bernieres', 3),
(20, 'War and Peace', 'Leo Tolstoy', 3),
(21, 'Gone with the Wind', 'Margaret Mitchell', 3),
(22, 'Harry Potter And The Philosopher\'s Stone', 'JK Rowling', 3),
(23, 'Harry Potter And The Chamber Of Secrets', 'JK Rowling', 3),
(24, 'Harry Potter And The Prisoner Of Azkaban', 'JK Rowling', 3),
(25, 'The Hobbit', 'JRR Tolkien', 3),
(26, 'Tess Of The D\'Urbervilles', 'Thomas Hardy', 3),
(27, 'Middlemarch', 'George Eliot', 3),
(28, 'A Prayer For Owen Meany', 'John Irving', 3),
(29, 'The Grapes Of Wrath', 'John Steinbeck', 3),
(30, 'Alice\'s Adventures In Wonderland', 'Lewis Carroll', 3),
(31, 'The Story Of Tracy Beaker', 'Jacqueline Wilson', 3),
(32, 'One Hundred Years Of Solitude', 'Gabriel García Márquez', 3),
(33, 'The Pillars Of The Earth', 'Ken Follett', 3),
(34, 'David Copperfield', 'Charles Dickens', 3),
(35, 'Charlie And The Chocolate Factory', 'Roald Dahl', 3),
(36, 'Treasure Island', 'Robert Louis Stevenson', 3),
(37, 'A Town Like Alice', 'Nevil Shute', 3),
(38, 'Persuasion', 'Jane Austen', 3),
(39, 'Dune', 'Frank Herbert', 3),
(40, 'Emma', 'Jane Austen', 3),
(41, 'Anne Of Green Gables', 'LM Montgomery', 3),
(42, 'Watership Down', 'Richard Adams', 3),
(43, 'The Great Gatsby', 'F Scott Fitzgerald', 3),
(44, 'The Count Of Monte Cristo', 'Alexandre Dumas', 3),
(45, 'Brideshead Revisited', 'Evelyn Waugh', 3),
(46, 'Animal Farm', 'George Orwell', 3),
(47, 'A Christmas Carol', 'Charles Dickens', 3),
(48, 'Far From The Madding Crowd', 'Thomas Hardy', 3),
(49, 'Goodnight Mister Tom', 'Michelle Magorian', 3),
(50, 'The Shell Seekers', 'Rosamunde Pilcher', 3),
(51, 'The Secret Garden', 'Frances Hodgson Burnett', 3),
(52, 'Of Mice And Men', 'John Steinbeck', 3),
(53, 'The Stand', 'Stephen King', 3),
(54, 'Anna Karenina', 'Leo Tolstoy', 3),
(55, 'A Suitable Boy', 'Vikram Seth', 3),
(56, 'The BFG', 'Roald Dahl', 3),
(57, 'Swallows And Amazons', 'Arthur Ransome', 3),
(58, 'Black Beauty', 'Anna Sewell', 3),
(59, 'Artemis Fowl', 'Eoin Colfer', 3),
(60, 'Crime And Punishment', 'Fyodor Dostoyevsky', 3),
(61, 'Noughts And Crosses', 'Malorie Blackman', 3),
(62, 'Memoirs Of A Geisha', 'Arthur Golden', 3),
(63, 'A Tale Of Two Cities', 'Charles Dickens', 3),
(64, 'The Thorn Birds', 'Colleen McCollough', 3),
(65, 'Mort', 'Terry Pratchett', 3),
(66, 'The Magic Faraway Tree', 'Enid Blyton', 3),
(67, 'The Magus', 'John Fowles', 3),
(68, 'Good Omens', 'Terry Pratchett and Neil Gaiman', 3),
(69, 'Guards! Guards!', 'Terry Pratchett', 3),
(70, 'Lord Of The Flies', 'William Golding', 3),
(71, 'Perfume', 'Patrick Süskind', 3),
(72, 'The Ragged Trousered Philanthropists', 'Robert Tressell', 3),
(73, 'Night Watch', 'Terry Pratchett', 3),
(74, 'Matilda', 'Roald Dahl', 3),
(75, 'Bridget Jones\'s Diary', 'Helen Fielding', 3),
(76, 'The Secret History', 'Donna Tartt', 3),
(77, 'The Woman In White', 'Wilkie Collins', 3),
(78, 'Ulysses', 'James Joyce', 3),
(79, 'Bleak House', 'Charles Dickens', 3),
(80, 'Double Act', 'Jacqueline Wilson', 3),
(81, 'The Twits', 'Roald Dahl', 3),
(82, 'I Capture The Castle', 'Dodie Smith', 3),
(83, 'Holes', 'Louis Sachar', 3),
(84, 'Gormenghast', 'Mervyn Peake', 3),
(85, 'The God Of Small Things', 'Arundhati Roy', 3),
(86, 'Vicky Angel', 'Jacqueline Wilson', 3),
(87, 'Brave New World', 'Aldous Huxley', 3),
(88, 'Cold Comfort Farm', 'Stella Gibbons', 3),
(89, 'Magician', 'Raymond E Feist', 3),
(90, 'On The Road', 'Jack Kerouac', 3),
(91, 'The Godfather', 'Mario Puzo', 3),
(92, 'The Clan Of The Cave Bear', 'Jean M Auel', 3),
(93, 'The Colour Of Magic', 'Terry Pratchett', 3),
(94, 'The Alchemist', 'Paulo Coelho', 3),
(95, 'Katherine', 'Anya Seton', 3),
(96, 'Kane And Abel', 'Jeffrey Archer', 3),
(97, 'Love In The Time Of Cholera', 'Gabriel García Márquez', 3),
(98, 'Girls In Love', 'Jacqueline Wilson', 3),
(99, 'The Princess Diaries', 'Meg Cabot', 3),
(100, 'Midnight\'s Children', 'Salman Rushdie', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `age` int(11) NOT NULL,
  `permission` enum('reader','admin') NOT NULL DEFAULT 'reader'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `login`, `password`, `age`, `permission`) VALUES
(1, 'Name', 'Surname', 'user', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 25, 'admin'),
(2, 'William', 'Smith', 'wsmith', 'c86622bdb8ab8f765fa51f509216e188e0b2767d', 20, 'reader'),
(3, 'James', 'Johnson', 'jjohnson', '0be26bd4edb4b73cd08f2f0161dcccefc8c1c2b0', 21, 'reader'),
(4, 'Charles', 'Williams', 'cwilliams', 'c8e012a832cdeaee1d1428d27b803f9a7e99f710', 22, 'reader'),
(5, 'George', 'Brown', 'gbrown', '99caefa222f2e5d37eb5f789a1d28e0b122ccfbf', 23, 'reader'),
(6, 'Frank', 'Jones', 'fjones', '1e4da905ba4c7ddf0ef8ea2d06e978d790318781', 24, 'reader'),
(7, 'Joseph', 'Garcia', 'jgarcia', '982c2fa77f17cfc01d78fad3acadae919b2f8264', 25, 'reader'),
(8, 'Thomas', 'Miller', 'tmiller', '9c1210254b3cedea6f7799ee27daa93ce63579c6', 26, 'reader'),
(9, 'Henry', 'Davis', 'hdavis', '0a8f38dc0637811e8083a919e90d838a88309592', 27, 'reader'),
(10, 'Robert', 'Rodriguez', 'rrodriguez', '9895a63cc80dcc5927568d2b1d09439531a4a91a', 28, 'reader'),
(11, 'Edward', 'Martinez', 'emartinez', 'af68fbe5d9d722013ad088a3fd7ab869700ecd41', 29, 'reader'),
(12, 'Harry', 'Hernandez', 'hhernandez', '390cf9385c264aa2cbabe87852bef478dc8a9af8', 30, 'reader'),
(13, 'Walter', 'Lopez', 'wlopez', '889d223a63823a409b22d94657644da56b5a116b', 31, 'reader'),
(14, 'Arthur', 'Gonzales', 'agonzales', '532b9a74ec0760103a1796d33d4c02f81cd8c207', 32, 'reader'),
(15, 'Fred', 'Wilson', 'fwilson', '0e72129018940a0373139370abb99d68242fd32d', 33, 'reader'),
(16, 'Albert', 'Anderson', 'aanderson', '758b757777175f2fe269cb23c35fa3d639ab8928', 34, 'reader'),
(17, 'Samuel', 'Thomas', 'sthomas', '70057f453423577300910f8d731f9c9b27b0f2fb', 35, 'reader'),
(18, 'David', 'Taylor', 'dtaylor', '00e45a97a7bb49fe356bc11a745fe985fdd94cd6', 36, 'reader'),
(19, 'Louis', 'Moore', 'lmoore', 'b3eaa368e4f082de743593b480b6fd97da95bd31', 37, 'reader'),
(20, 'Joe', 'Jackson', 'jjackson', 'f4b9ecf63bf5b989e7e552d4be974bedc84e8384', 38, 'reader'),
(21, 'Charlie', 'Martin', 'cmartin', '804ec66551768d6c59dd8949fd1df95fbf3b4309', 39, 'reader');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
