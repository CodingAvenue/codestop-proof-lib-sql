CREATE TABLE most_borrowed_books (
    title varchar (80), 
    author varchar (80), 
    publication_date DATE, 
    average_borrower_rating INT
);

INSERT INTO most_borrowed_books 
VALUES  ('The Little Prince', 'Antoine de Saint-Exupéry', '1943/04/06', 8),
        ('The Hobbit', 'J.R.R. Tolkien', '1937/09/21', 7),
        ('One Hundred Years of Solitude', 'Gabriel Garcí­a Márquez', '1967/05/30', 8),
        ('And Then There Were None', 'Agatha Christie', '1939/11/06', 8),
        ('Black Beauty', 'Anna Sewell', '1877/11/24', 8),
        ('The Very Hungry Caterpillar', 'Eric Carle', '1969/06/03', 9),
        ('Watership Down', 'Richard Adams', '1972/11/11', 7),
        ('The Gruffalo', 'Julia Donaldson', '1999/03/23', 9),
        ('Catch-22', 'Joseph Heller', '1961/11/10', 8),
        ('The Crossroads of Should and Must', 'Elle Luna', '2015/04/15', 8);