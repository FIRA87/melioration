

    <section class="services">
        <div class="container">
            <h2 class="mb-4">Услуги</h2>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 text-center">
                            <div class="card-body">
                                <div class="icon mb-3">
                                    <i class="{{ $service->icon ?? 'bi bi-gear' }}" style="font-size:2rem;"></i>
                                </div>
                                <h5>{{ $service->title_tj }}</h5>
                                <button class="btn btn-success mt-3 order-service-btn"
                                        data-service-id="{{ $service->id }}"
                                        data-service-name="{{ $service->title_tj }}">
                                    Заказать услугу
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="orderForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Заполните форму</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="service_id" id="service_id">

                        <div class="mb-3">
                            <label>ФИО</label>
                            <input type="text" name="fio" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Телефон</label>
                            <input type="text" name="phone" class="form-control" placeholder="+992 ..." required>
                        </div>

                        <div class="mb-3">
                            <label>Комментарий</label>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = new bootstrap.Modal(document.getElementById('orderModal'));
            const form = document.getElementById('orderForm');

            document.querySelectorAll('.order-service-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('service_id').value = btn.dataset.serviceId;
                    modal.show();
                });
            });

            form.addEventListener('submit', e => {
                e.preventDefault();
                fetch("{{ route('service.request') }}", {
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value},
                    body: new FormData(form)
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            alert('Заявка успешно отправлена!');
                            modal.hide();
                            form.reset();
                        }
                    })
                    .catch(() => alert('Ошибка при отправке'));
            });
        });
    </script>
