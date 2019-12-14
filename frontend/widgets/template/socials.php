<div class="footer-icons">
<? foreach ($data as $social): ?>
    <a href="<?= $social->href; ?>"><img src="<?= $social->path; ?>" alt="<?= $social->name; ?>" title="<?= $social->name; ?>" width="24" height="24"></a>
<? endforeach; ?>
</div>
