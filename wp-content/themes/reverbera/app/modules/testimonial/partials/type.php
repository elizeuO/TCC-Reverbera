<div>
    <label>
        <input type="radio" name="testimonial[testimonial_type]"
               value="Texto" <?= $testimonial->getType() === 'Texto' ? 'checked' : '' ?>>
        Texto
    </label>
</div>
<div>
    <label>
        <input type="radio" name="testimonial[testimonial_type]"
               value="Vídeo" <?= $testimonial->getType() === 'Vídeo' ? 'checked' : '' ?>>
        Vídeo
    </label>
</div>