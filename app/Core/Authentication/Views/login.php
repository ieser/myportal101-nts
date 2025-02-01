<div class="row vh-100">
    <div class="col-12 col-md-6 px-0 d-none d-sm-flex flex-column align-items-center justify-content-center bg-main-light">
        <div class="d-flex align-items-center flex-column">
            <a href="/it/"><img src="img/logos/logo.svg" style="max-width:100px;"></a>
            <h3 class="mt-3 fw-bold">Welcome to NTS MyPortal</h3>
        </div>
        <img src="/img/login.png" alt="Login background image" class="" style="max-width:400px;">
    </div>
    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
        <form class="" method="post" action="/login" accept-charset="UTF-8" id="login-form" style="width:350px;">
            <input type="hidden" name="csrf" id="csrf" value="<?=$csrf; ?>"/>
            <h3 class="text-center fw-bold mb-3 pb-3"><?=$tr["login"];?></h3>

            <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class="form-control" placeholder=" " autocomplete="email" required>
                <label for="email"><?=$tr["login"];?> </label>
                <div class="invalid-feedback" id="invalid-email-feedback"><?=$tr["invalid-email-feedback"];?></div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control"  placeholder=" " required>
                        <label for="password"><?=$tr["password"];?></label>
                    </div>
                    <span class="input-group-text" id="show-password"><i class="fa-solid fa-fw fa-eye"></i></span>
                </div>
                <div class="invalid-feedback" id="css-detected-feedback"><?=$tr["css-detected-feedback"];?></div>
                <div class="invalid-feedback" id="login-incorrect-feedback"><?=$tr["login-incorrect-feedback"];?></div>
            </div>
            <div class="input-group mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" name="remember-me" id="remember-me" checked>
                    <label class="form-check-label" for="remember-me"><?=$tr["remember-me"];?></label>
                </div>
            </div>
            <div class="d-grid gap-2 pt-1 mb-3">
                <button type="button" class="btn btn-primary" id="login-button" >
                    <span class="spinner-grow" style="display:none"></span>
                    <span class="continue"><?=$tr["continue"];?></span>
                </button>
                <span class="text-center">OR</span>
                <button id="login-microsoft" class="btn btn-outline-primary oauth-login">
                    <i class="fab fa-microsoft me-2"></i> Accedi con Microsoft
                </button>
                <button id="login-google" class="btn    btn-outline-danger oauth-login">
                    <i class="fab fa-google me-2"></i> Accedi con Google
                </button>
            </div>
        </form>
    </div>
</div>