<div class="admin-form-grid">

  <div class="admin-form-field admin-form-field--wide">
    <label for="nombre">Nombre <span class="admin-required">*</span></label>
    <input
      type="text" id="nombre" name="nombre"
      value="{{ old('nombre', $producto->nombre ?? '') }}"
      placeholder="Ej: Cerezas ecológicas"
      maxlength="120" required
    >
    @error('nombre') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label for="variedad">Variedad</label>
    <input
      type="text" id="variedad" name="variedad"
      value="{{ old('variedad', $producto->variedad ?? '') }}"
      placeholder="Ej: Picota del Jerte"
      maxlength="80"
    >
    @error('variedad') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label for="formato">Formato</label>
    <input
      type="text" id="formato" name="formato"
      value="{{ old('formato', $producto->formato ?? '') }}"
      placeholder="Ej: 1 kg"
      maxlength="60"
    >
    @error('formato') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label for="precio">Precio (€) <span class="admin-required">*</span></label>
    <input
      type="number" id="precio" name="precio"
      value="{{ old('precio', $producto->precio ?? '') }}"
      step="0.01" min="0" placeholder="0.00" required
    >
    @error('precio') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field admin-form-field--wide">
    <label for="imagen">Imagen</label>
    @if (!empty($producto->imagen))
      <div class="admin-form-preview">
        <img src="{{ asset($producto->imagen) }}" alt="Imagen actual">
        <span class="admin-form-preview__label">Imagen actual — sube una nueva para reemplazarla</span>
      </div>
    @endif
    <input type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp">
    <span class="admin-form-hint">JPG, PNG o WebP · Máx. 2 MB</span>
    @error('imagen') <span class="admin-form-error">{{ $message }}</span> @enderror
  </div>

  <div class="admin-form-field">
    <label class="admin-form-check">
      <input
        type="checkbox" name="disponible" value="1"
        {{ old('disponible', $producto->disponible ?? true) ? 'checked' : '' }}
      >
      <span>Disponible para la venta</span>
    </label>
  </div>

</div>
