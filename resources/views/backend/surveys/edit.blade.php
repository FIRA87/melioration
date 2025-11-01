@extends('admin.admin_dashboard')
@section('admin')

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container py-4" x-data="editSurvey(@json($survey))">
    <h3>Редактировать опрос</h3>

    <form @submit.prevent="submit">
        <div class="mb-2">
            <label>Заголовок (RU)</label>
            <input type="text" x-model="form.title_ru" class="form-control">
        </div>
        <div class="mb-2">
            <label>Заголовок (TJ)</label>
            <input type="text" x-model="form.title_tj" class="form-control">
        </div>
        <div class="mb-2">
            <label>Заголовок (EN)</label>
            <input type="text" x-model="form.title_en" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit" x-text="loading ? 'Сохраняю...' : 'Сохранить'"></button>
    </form>

    <div x-show="message" class="mt-3 alert" :class="messageType == 'success' ? 'alert-success' : 'alert-danger'">
        <span x-text="message"></span>
    </div>
</div>

<script>
function editSurvey(survey){
    return {
        form: {
            title_ru: survey.title_ru || '',
            title_tj: survey.title_tj || '',
            title_en: survey.title_en || '',
            description_ru: survey.description_ru || '',
            description_tj: survey.description_tj || '',
            description_en: survey.description_en || '',
            is_active: survey.is_active ? 1 : 0
        },
        loading:false,
        message:'',
        messageType:'success',
        async submit(){
            this.loading = true;
            try {
                const res = await fetch("/admin/surveys/" + {{ $survey->id }}, {
                    method: 'PUT',
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
                this.message = 'Опрос обновлён';
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
