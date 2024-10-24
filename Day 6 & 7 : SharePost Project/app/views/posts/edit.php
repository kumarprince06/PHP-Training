<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="form-body mt-3">
    <div class="row">
        <div class="form-content">
            <div class="form-items">
                <h3 class="text-center border bg-secondary text-light rounded-pill">Edit Post</h3>

                <!-- Back Button -->
                <a href="<?php echo URLROOT ?>/posts/index" class="btn btn-dark m-3 ">Back</a>

                <form class="requires-validation" novalidate action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
                    <!-- Post Title Input -->
                    <div class="col-md-6 m-2 mx-auto">
                        <input class="form-control <?php echo !empty($data['postTitleError']) ? 'is-invalid' : ''; ?>"
                            type="text" name="postTitle" placeholder="Post title.."
                            value="<?php echo $data['postTitle']; ?>">
                        <?php if (!empty($data['postTitleError'])) : ?>
                            <div class="invalid-feedback"><?php echo $data['postTitleError']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Post Body Input -->
                    <div class="col-md-6 m-2 mx-auto">
                        <textarea class="form-control <?php echo !empty($data['bodyError']) ? 'is-invalid' : ''; ?>"
                            name="body" placeholder="Post body.."><?php echo $data['body']; ?></textarea>
                        <?php if (!empty($data['bodyError'])) : ?>
                            <div class="invalid-feedback"><?php echo $data['bodyError']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-button text-center mt-3 mx-auto">
                        <button id="submit" type="submit" class="btn btn-success ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>