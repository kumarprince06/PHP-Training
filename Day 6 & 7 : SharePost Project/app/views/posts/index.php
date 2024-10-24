<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6 mt-2 text-end"> <!-- Use text-end for right alignment -->
        <a href="<?php echo URLROOT ?>/posts/add" class="btn btn-primary">
            <i class="fa-solid fa-pencil"></i> Add Post
        </a>
    </div>
</div>

<?php flashMessage('postMessage'); ?> <!-- Flash message should show here -->

<?php if (!empty($data['posts'])) : ?>
    <?php foreach ($data['posts'] as $post) :  ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo htmlspecialchars($post->title); ?></h4>
            <div class="bg-light p-2 mb-3">
                Written by <strong>- <?php echo htmlspecialchars($post->name); ?> on
                    <?php
                    // Format the createdAt date
                    echo date("F j, Y, g:i a", strtotime($post->created_at));
                    ?>
                </strong>
            </div>
            <p class="card-body"><?php echo $post->body; ?></p>
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-warning">No posts found.</div>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>