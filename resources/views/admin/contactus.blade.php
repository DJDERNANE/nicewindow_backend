@extends('layouts.admin.app')

@section('content')
  <h2>الرسائل</h2>
  <div class="card">
    <div class="card-body">
      <table class="table-one">
        <thead>
          <tr>
            <th>#</th>
            <th>الإسم الكامل</th>
            <th>البريد الإلكتروني</th>
            <th>عنوان الشبكة</th>
            <th>العنوان</th>
            <th>إعدادات</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($messages as $message)
            <tr id="tr{{ $message->id }}" style="background-color:{{ $message->status == 'unread' ? '#ddd' : '#fff'  }};">
              <td>{{ $message->id }}</td>
              <td>{{ $message->fullname }}</td>
              <td>{{ $message->email }}</td>
              <td>{{ $message->ip }}</td>
              <td>{{ $message->subject }}</td>
              <td>
                <button 
                  type="button" 
                  class="btn btn-success btn-xs" 
                  data-bs-target="#viewModal" 
                  data-bs-toggle="modal"
                  data-fullname="{{ $message->fullname }}"
                  data-email="{{ $message->email }}"
                  data-subject="{{ $message->subject }}"
                  data-message="{{ $message->message }}"
                  data-phone_number="{{ $message->phone_number }}"
                  onclick="readMessage('{{ $message->id }}');" 
                >
                  <ion-icon name="mail-open-outline"></ion-icon>
                </button>
                <button type="button" class="btn btn-danger btn-xs" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="$('#id-for-destroy').val('{{ $message->id }}');">
                  <ion-icon name="trash-outline"></ion-icon>
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td align="center" colspan="6">لا توجد بيانات</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if ($messages && count($messages) > 0)
      <div class="card-footer">
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?= $messages->previousPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$messages->previousPageUrl().'"> '.($messages->currentPage()-1).' </a></li>' : '' ?>
            <li class="page-item disabled"><a class="page-link" href="{{ $messages->url($messages->currentPage()) }}"> {{ $messages->currentPage() }} </a></li>
            <?= $messages->nextPageUrl() ? '<li class="page-item"><a class="page-link" href="'.$messages->nextPageUrl().'"> '.($messages->currentPage()+1).' </a></li>' : '' ?>
          </ul>
        </nav>
      </div>
    @endif
  </div>

  {{-- START view modal --}}
  <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">الرسالة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">الإسم الكامل: </label>
            <input class="form-control border-2" id="v-fullname" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label">البريد الإلكتروني: </label>
            <input class="form-control border-2" id="v-email" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label">رقم الهاتف: </label>
            <input class="form-control border-2" id="v-phone_number" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label">العنوان: </label>
            <input class="form-control border-2" id="v-subject" readonly />
          </div>
          <div class="mb-3">
            <label class="form-label">الرسالة: </label>
            <textarea class="form-control border-2" readonly id="v-message"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
        </div>
      </div>
    </div>
  </div>
  {{-- END view modal --}}

  {{-- START delete modal --}}
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">هل حقا تريد حذف الرسالة؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_to_delete" value="" id="id-for-destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroyMessage();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  {{-- END delete modal --}}
@endsection

@section('scripts')
  <script type="text/javascript">
    function destroyMessage() {
      let id = $('#id-for-destroy').val();
      $.post('{{ route('admin.contactus.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).remove();
      }, 'json');
    }

    function readMessage(id) {
      $.post('{{ route('admin.contactus.read') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
        $('#tr'+id).css({'background-color': '#fff'});
      }, 'json');
    }

    $('#viewModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var fullname = button.data('fullname');
      var email = button.data('email');
      var phone_number = button.data('phone_number');
      var subject = button.data('subject');
      var message = button.data('message');
      var modal = $(this);
      modal.find('#v-fullname').val(fullname);
      modal.find('#v-email').val(email);
      modal.find('#v-subject').val(subject);
      modal.find('#v-message').val(message);
      modal.find('#v-phone_number').val(phone_number);
    });
  </script>
@endsection