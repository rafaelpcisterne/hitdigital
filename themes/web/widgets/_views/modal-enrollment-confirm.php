<div class="modal_content modal-enrollment-confirm radius">
    <?php $user = (new \Source\Models\User())->findById($user); ?>
    <div class="form_login">
        <h1 class="icon-user-plus">Confirmar Matrícula:</h1>
        <p>Olá, você está preparad<?= ($user->genre == 1 ? "a" : "o"); ?> para se matricular, criar peças incríveis e
            faturar muito?!</p>
        <div class="action_enrollment_confirm">
            <span class="btn btn-green text-upper icon-check j_enrollment_confirm"
                  data-url="<?= $router->route("course.enrollment"); ?>"
                  data-user="<?= $user->id; ?>"
                  data-course="<?= $course->id; ?>">Confirmar matrícula</span>
            <span class="btn btn-red text-upper icon-check j_enrollment_cancel">Cancelar</span>
        </div>
    </div>
</div>