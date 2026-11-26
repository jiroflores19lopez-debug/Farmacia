<div class="row">
<div class="col-md-6 mb-3"><label class="form-label" for="nombre">Nombre completo</label><input class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $customer->nombre ?? '') }}" maxlength="50" required></div>
<div class="col-md-6 mb-3"><label class="form-label" for="dni">DNI</label><input class="form-control" id="dni" name="dni" value="{{ old('dni', $customer->dni ?? '') }}" inputmode="numeric" maxlength="8" required></div>
<div class="col-md-6 mb-3"><label class="form-label" for="phone">Teléfono</label><input class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" maxlength="20"></div>
<div class="col-md-6 mb-3"><label class="form-label" for="age">Edad</label><input class="form-control" id="age" name="age" type="number" min="0" max="120" value="{{ old('age', $customer->age ?? '') }}"></div>
</div>
<button class="btn btn-primary text-white" type="submit">Guardar</button> <a class="btn btn-outline-secondary" href="{{ route('customers.index') }}">Cancelar</a>
