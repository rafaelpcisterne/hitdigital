<?php $v->layout("admin/_theme"); ?>
<?php $url = filter_input(INPUT_GET, "route", FILTER_SANITIZE_STRIPPED); ?>

<header class="dash_main_header">
    <span class="icon-bars icon-notext dash_main_header_menu radius transition"></span>
    <h2 class="dash_main_header_view">
        <a href="<?= site("/admin/cursos"); ?>" title="Dashboard" class="transition">Dashboard</a>
        | Introdução
    </h2>
    <?php $v->insert("admin/widgets/_views/notify-logoff"); ?>
</header>

<div class="dash_main_content">
    <div class="dash_main_content_box">
        <div class="box">
            <div class="box100">
                <div class="tab_content active" id="course">
                    <form action="<?= $router->route("introduction.home"); ?>"
                          method="post" enctype="multipart/form-data" class="dash_form radius">
                        <input type="hidden" name="action" value="ok">
                        <label>
                            <span>Introdução:</span>
                            <textarea class="radius mce" name="description"
                                      placeholder="Descrição:"><?= (!empty($introduction->description) ? $introduction->description : ""); ?></textarea>
                        </label>
                        <div class="dash_form_actions">
                            <button class="btn btn-green icon-check">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>