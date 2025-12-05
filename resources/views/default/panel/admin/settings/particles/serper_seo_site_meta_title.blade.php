<input
        class="form-control {{ setting('serper_seo_site_meta', 0) == 1 ? 'input-seo' : '' }}"
        id="meta_title"
        type="text"
        name="meta_title"
        value="{{ $setting->meta_title }}"
>