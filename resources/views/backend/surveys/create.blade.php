@extends('admin.admin_dashboard')
@section('admin')

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div x-data="createSurvey()" class="container py-4">
    <h3>Создать опрос</h3>

    <form @submit.prevent="submit">
        <div class="mb-2">
            <label class="form-label">Заголовок (RU)</label>
            <input type="text" x-model="form.title_ru" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Заголовок (TJ)</label>
            <input type="text" x-model="form.title_tj" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Заголовок (EN)</label>
            <input type="text" x-model="form.title_en" class="form-control" required>
        </div>

        <button class="btn btn-success" type="submit" x-text="loading ? 'Сохраняю...' : 'Создать'"></button>
    </form>

    <div x-show="message" class="alert mt-3" :class="messageType == 'success' ? 'alert-success' : 'alert-danger'">
        <span x-text="message"></span>
    </div>
</div>

<script>
function createSurvey(){
    return {
        form: { title_ru:'', title_tj:'', title_en:'' },
        loading: false,
        message: '',
        messageType: 'success',
        async submit(){
            this.loading = true;
            try {
                const res = await fetch("{{ route('admin.surveys.store') }}", {
                    method: 'POST',
                    headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                    body: JSON.stringify(this.form)
                });
                const data = await res.json();
                if(!res.ok){
                    this.messageType = 'danger';
                    this.message = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Ошибка');
                    this.loading = false;
                    return;
                }
                this.messageType = 'success';
                this.message = 'Опрос создан';
                this.form = { title_ru:'', title_tj:'', title_en:'' };
                this.loading = false;
            } catch (e){
                this.loading = false;
                this.messageType = 'danger';
                this.message = 'Ошибка сервера';
            }
        }
    }
}
</script>

@endsection
