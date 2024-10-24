<!-- Use Bootstrap classes to change the background -->
<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-3 text-center">
        <h1 class="display-5 fw-bold"><?php echo $data['title']; ?></h1>
        <p class="lead">
            <?php echo isset($data['description']) ? $data['description'] : 'No description available.'; ?>
        </p>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>