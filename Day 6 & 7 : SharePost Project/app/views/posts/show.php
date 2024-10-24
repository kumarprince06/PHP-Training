<?php require APPROOT . '/views/includes/header.php'; ?>
<!-- Back Button -->
<a href="<?php echo URLROOT ?>/posts/index" class="btn btn-dark m-3">Back</a>

<h1><?php echo htmlspecialchars($data['post']->title); ?></h1>

<div class="bg-secondary text-white p-2 mb-2">
    Written by - <strong><?php echo htmlspecialchars($data['user']->name); ?> on <?php echo date("F j, Y, g:i a", strtotime($data['post']->createdAt)); ?></strong>
</div>

<p><?php echo htmlspecialchars($data['post']->body); ?></p>

<?php if ($data['post']->userId == $_SESSION['user_id']): ?>
    <hr>
    <div class="d-flex justify-content-between">
        <a href="<?php echo URLROOT ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-warning">Edit</a>

        <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>