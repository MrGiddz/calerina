<textarea
        class="form-control {{ setting('serper_seo_site_meta', 0) == 1 ? 'input-seo' : '' }}"
        id="meta_description"
        name="meta_description"
        rows="5"
>{{ $setting->meta_description }}</textarea>