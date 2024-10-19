<h1>Edit Book</h1>
<form method="POST" action="">
    <label>Title: </label><input type="text" name="title" value="<?php echo $book['title']; ?>" required><br>
    <label>Author: </label><input type="text" name="author" value="<?php echo $book['author']; ?>" required><br>
    <label>Published Year: </label><input type="number" name="published_year" value="<?php echo $book['published_year']; ?>" required><br>
    <input type="submit" value="Update Book">
</form>
<a href="index.php">Back to List</a>