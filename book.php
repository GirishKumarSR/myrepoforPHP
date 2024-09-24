<?php
// File: Book.php

class Book {
    private $id;
    private $title;
    private $author;
    private $publishedYear;
    private $available;

    // Constructor
    public function __construct($id, $title, $author, $publishedYear) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->publishedYear = $publishedYear;
        $this->available = true; // All books are available by default
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPublishedYear() {
        return $this->publishedYear;
    }

    public function isAvailable() {
        return $this->available;
    }

    // Setters
    public function setAvailability($availability) {
        $this->available = $availability;
    }

    // Method to display book details
    public function displayBookInfo() {
        echo "ID: " . $this->id . "\n";
        echo "Title: " . $this->title . "\n";
        echo "Author: " . $this->author . "\n";
        echo "Published Year: " . $this->publishedYear . "\n";
        echo "Available: " . ($this->available ? "Yes" : "No") . "\n";
    }
}

// File: Library.php

class Library {
    private $books = [];

    // Add a new book to the library
    public function addBook(Book $book) {
        $this->books[$book->getId()] = $book;
    }

    // Remove a book from the library by its ID
    public function removeBook($bookId) {
        if (isset($this->books[$bookId])) {
            unset($this->books[$bookId]);
            echo "Book with ID $bookId has been removed.\n";
        } else {
            echo "Book with ID $bookId not found in the library.\n";
        }
    }

    // List all books in the library
    public function listAllBooks() {
        if (empty($this->books)) {
            echo "No books available in the library.\n";
        } else {
            foreach ($this->books as $book) {
                $book->displayBookInfo();
                echo "-------------------\n";
            }
        }
    }

    // Search for a book by its title
    public function searchBookByTitle($title) {
        $foundBooks = [];
        foreach ($this->books as $book) {
            if (stripos($book->getTitle(), $title) !== false) {
                $foundBooks[] = $book;
            }
        }

        if (empty($foundBooks)) {
            echo "No books found with the title: $title\n";
        } else {
            echo "Books found with the title '$title':\n";
            foreach ($foundBooks as $book) {
                $book->displayBookInfo();
                echo "-------------------\n";
            }
        }
    }

    // Lend a book to a user by ID
    public function lendBook($bookId) {
        if (isset($this->books[$bookId])) {
            $book = $this->books[$bookId];
            if ($book->isAvailable()) {
                $book->setAvailability(false);
                echo "Book titled '" . $book->getTitle() . "' has been lent.\n";
            } else {
                echo "Book titled '" . $book->getTitle() . "' is not available for lending.\n";
            }
        } else {
            echo "Book with ID $bookId not found in the library.\n";
        }
    }

    // Return a book to the library by ID
    public function returnBook($bookId) {
        if (isset($this->books[$bookId])) {
            $book = $this->books[$bookId];
            if (!$book->isAvailable()) {
                $book->setAvailability(true);
                echo "Book titled '" . $book->getTitle() . "' has been returned.\n";
            } else {
                echo "Book titled '" . $book->getTitle() . "' was not borrowed.\n";
            }
        } else {
            echo "Book with ID $bookId not found in the library.\n";
        }
    }
}

// File: index.php

// Including classes (require the files if stored separately)
require 'Book.php';
require 'Library.php';

// Create library instance
$library = new Library();

// Create some books
$book1 = new Book(1, "The Catcher in the Rye", "J.D. Salinger", 1951);
$book2 = new Book(2, "1984", "George Orwell", 1949);
$book3 = new Book(3, "To Kill a Mockingbird", "Harper Lee", 1960);

// Add books to the library
$library->addBook($book1);
$library->addBook($book2);
$library->addBook($book3);

// List all books in the library
echo "Listing all books in the library:\n";
$library->listAllBooks();

// Search for a book by title
echo "\nSearching for books with title '1984':\n";
$library->searchBookByTitle("1984");

// Lend a book
echo "\nLending a book (ID: 2):\n";
$library->lendBook(2);

// Try to lend the same book again
echo "\nTrying to lend the same book again (ID: 2):\n";
$library->lendBook(2);

// Return the book
echo "\nReturning the book (ID: 2):\n";
$library->returnBook(2);

// Remove a book from the library
echo "\nRemoving a book (ID: 3):\n";
$library->removeBook(3);

// List all books after removal
echo "\nListing all books in the library after removal:\n";
$library->listAllBooks();
?>
