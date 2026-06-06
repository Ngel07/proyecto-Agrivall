<div class="admin-form-grid">

  <div class="admin-form-field admin-form-field--wide">
    <label for="titulo">Título <span class="admin-required">*</span></label>
    <input
      type="text" id="titulo" name="titulo"
      value="{{ old('titulo', $post->titulo ?? '') }}"
      placeholder="Ej: Temporada de cerezas: todo lo que necesitas saber"
      maxlength="255" required
    >
    @error('titulo') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label for="tipo_post_id">Categoría <span class="admin-required">*</span></label>
    <select id="tipo_post_id" name="tipo_post_id" required>
      <option value="">— Selecciona —</option>
      @foreach ($tipos as $tipo)
        <option value="{{ $tipo->id }}"
          {{ old('tipo_post_id', $post->tipo_post_id ?? '') == $tipo->id ? 'selected' : '' }}>
          {{ $tipo->tipo }}
        </option>
      @endforeach
    </select>
    @error('tipo_post_id') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label for="fecha_public">Fecha de publicación <span class="admin-required">*</span></label>
    <input
      type="date" id="fecha_public" name="fecha_public"
      value="{{ old('fecha_public', isset($post->fecha_public) ? $post->fecha_public->format('Y-m-d') : date('Y-m-d')) }}"
      required
    >
    @error('fecha_public') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field admin-form-field--wide">
    <label for="imagen">Imagen</label>
    @if (!empty($post->imagen))
      <div class="admin-form-preview">
        <img src="{{ asset('images/' . $post->imagen) }}" alt="Imagen actual">
        <span class="admin-form-preview__label">Imagen actual — sube una nueva para reemplazarla</span>
      </div>
    @endif
    <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp">
    <span class="admin-form-hint">JPG, PNG o WebP · Máx. 2 MB</span>
    @error('imagen') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field admin-form-field--wide">
    <label for="noticia">Contenido <span class="admin-required">*</span></label>
    <textarea id="noticia" name="noticia" rows="16" placeholder="Escribe el contenido del post en HTML..." required>{{ old('noticia', $post->noticia ?? '') }}</textarea>
    <span class="admin-form-hint">Puedes usar etiquetas HTML: &lt;p&gt;, &lt;h2&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;blockquote&gt;</span>
    @error('noticia') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

</div>
