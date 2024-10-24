<?php require APPROOT . '/views/includes/header.php'; ?>

<div class="form-body mt-3">
    <div class="row">
        <div class="form-content">
            <div class="form-items">
                <h3 class="text-center border bg-secondary text-light rounded-pill">Login</h3>
                <?php flashMessage('register_success'); ?> <!-- Flash message should show here -->
                <form class="requires-validation" novalidate action="<?php echo URLROOT; ?>/auth/login" method="post">

                    <!-- Email Input -->
                    <div class="col-md-6 m-2 mx-auto">
                        <input class="form-control <?php echo !empty($data['emailError']) ? 'is-invalid' : ''; ?>"
                            type="email" name="email" placeholder="E-mail Address"
                            value="<?php echo $data['email']; ?>">
                        <?php if (!empty($data['emailError'])) : ?>
                            <div class="invalid-feedback"><?php echo $data['emailError']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Password Input -->
                    <div class="col-md-6 m-2 mx-auto">
                        <input class="form-control <?php echo !empty($data['passwordError']) ? 'is-invalid' : ''; ?>"
                            type="password" name="password" placeholder="Password"
                            value="<?php echo $data['password']; ?>">
                        <?php if (!empty($data['passwordError'])) : ?>
                            <div class="invalid-feedback"><?php echo $data['passwordError']; ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-button text-center mt-3 mx-auto">
                        <button id="submit" type="submit" class="btn btn-success">Login</button>
                        <p class="m-1">Don't have an account?
                            <a href="<?php echo URLROOT; ?>/auth/register" class="text-decoration-none">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>