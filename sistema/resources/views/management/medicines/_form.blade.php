<div class="row">
<div class="col-md-6 mb-3"><label class="form-label" for="name">Nombre</label><input class="form-control" id="name" name="name" value="{{ old('name', $medicine->name ?? '') }}" maxlength="120" required></div>
<div class="col-md-6 mb-3"><label class="form-label" for="category_id">Categoría</label><select class="form-select" id="category_id" name="category_id" required><option value="">Selecciona una categoría</option>@foreach ($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $medicine->category_id ?? '') == $category->id)>{{ $category->nombre }}</option>@endforeach</select></div>
<div class="col-md-6 mb-3"><label class="form-label" for="price">Precio (S/)</label><input class="form-control" id="price" name="price" type="number" step="0.01" min="0.01" value="{{ old('price', $medicine->price ?? '') }}" required></div>
<div class="col-md-6 mb-3"><label class="form-label" for="stock">Stock</label><input class="form-control" id="stock" name="stock" type="number" step="1" min="0" value="{{ old('stock', $medicine->stock ?? 0) }}" required></div>
</div>
<button class="btn btn-primary text-white" type="submit">Guardar</button> <a class="btn btn-outline-secondary" href="{{ route('medicines.index') }}">Cancelar</a>
