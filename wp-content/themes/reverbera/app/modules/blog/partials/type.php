<div>
    <label class="col-md-6">
        <input type="radio" name="type" value="text" <?= $itemPost->getType() === 'text' ? 'checked' : '' ?>>
        Texto
    </label>
</div>
<div>
    <label class="col-md-6">
        <input type="radio" name="type" value="video" <?= $itemPost->getType() === 'video' ? 'checked' : '' ?>>
        Vídeo
    </label>
</div>