<article class="list_item">
    <header>
        <a href="<?= site("/aula/" . (!empty($class) ? $class->uri : $course->uri)); ?>" title="<?= $course->title; ?>">
            <span class="transition"></span>
            <img src="<?= (!empty($course->cover) ? image($course->cover, 768, 432) :
                asset("images/no_image_16_9.jpg")); ?>" alt="[<?= $course->title; ?>]" title="<?= $course->title; ?>">
        </a>
    </header>
    <h1>
        <a href="<?= site("/aula/" . (!empty($class) ? $class->uri : $course->uri)); ?>"
           title="<?= $course->title; ?>" class="transition">
            <?= $course->title; ?>
        </a>
    </h1>

    <p>Tempo de Aula: <span class="icon-clock-o">
            <?= (!empty($class) ? (floor($class->time / 60) >= 1 ? floor($class->time / 60) . "h " : "") .
                (str_pad($class->time % 60, 2, 0, 0) >= 1 ? str_pad($class->time % 60, 2, 0,
                        0) . "min" : 0 . "min") : "0"); ?></span></p>
</article>