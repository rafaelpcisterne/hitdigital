<article class="list_item">
    <header class="no_bg">
        <a href="<?= site("/curso/{$course->uri}"); ?>" title="<?= $course->title; ?>">
            <img src="<?= (!empty($course->cover) ? image($course->cover, 768, 432) :
                asset("images/no_image_16_9.jpg")); ?>" alt="[<?= $course->title; ?>]"
                 title="<?= $course->title; ?>">
        </a>
    </header>
    <h1>
        <a href="<?= site("/curso/{$course->uri}"); ?>" title="<?= $course->title; ?>" class="transition">
            <?= $course->title; ?>
        </a>
    </h1>
    <p><?= $course->headline ?></p>
    <p class="time"><?= $classCount; ?> aula<?= $classCount > 1 ? "s" : ""; ?>
        no total de
        <?php if (floor($courseTime / 60) > 0): ?>
            <?= floor($courseTime / 60) . " hora" . (floor($courseTime / 60) > 1 ? "s" : "") . ($courseTime % 60 >= 1 ? " e " : "") .
            ($courseTime % 60 >= 1 ? str_pad($courseTime % 60, 2, 0,
                    0) . " minuto" . ($courseTime % 60 > 1 ? "s" : "") : ""); ?>
        <?php else: ?>
            <?= str_pad($courseTime % 60, 2, 0, 0) . " minutos"; ?>
        <?php endif; ?>
        de curso!
    </p>

    <div class="action">
        <a href="<?= site("/curso/{$course->uri}"); ?>" title="Saiba mais" class="btn">Saiba Mais</a>
    </div>
</article>