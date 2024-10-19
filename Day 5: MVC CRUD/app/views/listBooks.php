<h1>Book List</h1>
<a href="index.php?action=create">Add New Book</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Published Year</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><?php echo $book['title']; ?></td>
            <td><?php echo $book['author']; ?></td>
            <td><?php echo $book['published_year']; ?></td>
            <td>
                <a href="index.php?action=edit&id=<?php echo $book['id']; ?>">Edit</a>
                <a href="index.php?action=delete&id=<?php echo $book['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>