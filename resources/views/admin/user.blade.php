@extends('layouts.admin.app')

@section('content')
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if(session()->has('error'))
  <div class="alert alert-danger">
    {{ session()->get('error') }}
  </div>
  @endif
  @if(session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
  @endif

  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <h4 class="fw-bold my-2">معلومات رئيسية</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.user.settings.general.update') }}" method="POST">
            @csrf
            <div class="text-center mb-5 mt-3">
              <img src="{{ empty($user->profile_photo_path) ? asset('assets/admin/images/default_user.png') : $user->profile_photo_path }}" alt="" width="200px" />
            </div>
            <div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">الإسم: </label>
                  <input type="text" name="firstname" value="{{ $user->firstname }}" class="form-control form-control-lg border-2" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">اللقب: </label>
                  <input type="text" name="lastname" value="{{ $user->lastname }}" class="form-control form-control-lg border-2" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">البريد الإلكتروني: </label>
                  <input type="text" name="email" value="{{ $user->email }}" class="form-control form-control-lg border-2" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">رقم الهاتف: </label>
                  <input type="text" name="phone_number" value="{{ $user->phone_number }}" class="form-control form-control-lg border-2" required />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">إسم الشركة: </label>
                  <input type="text" name="company_name" value="{{ $user->company_name }}" class="form-control form-control-lg border-2" />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">تاريخ التسجيل: </label>
                  <input type="text" readonly value="{{ $user->created_at }}" class="form-control form-control-lg border-2" />
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="id" value="{{ $user->id }}" />
                  <button class="btn btn-dark btn-lg w-100">حفظ</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card mb-3">
        <div class="card-header">
          <h4 class="fw-bold my-2">إعدادات الحماية</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.user.settings.security.update') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">كلمة المرور الجديدة: </label>
              <input type="password" name="new_password" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">تأكيد كلمة المرور الجديدة: </label>
              <input type="password" name="new_password_confirmation" class="form-control form-control-lg border-2" required />
            </div>
            <div>
              <input type="hidden" name="id" value="{{ $user->id }}" />
              <button class="btn btn-danger btn-lg w-100">حفظ</button>
            </div>
          </form>
        </div>
      </div>

      @if (intval($user->type) === 2 || intval($user->type) === 3)
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-8">
                <h4 class="fw-bold my-2">الإشتراكات</h4>
              </div>
              <div class="col-4 text-end">
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addSubscribtionModal">+</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if (App\Models\Subscribtion::count() > 0)
              <table class="table-one">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>البداية</th>
                    <th>النهاية</th>
                    <th>الحالة</th>
                    <th>إعدادات</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($subscribtions as $subscribtion)
                    <tr id="subscribtion_tr{{ $subscribtion->id }}">
                      <td>{{ $subscribtion->id }}</td>
                      <td>{{ $subscribtion->start }}</td>
                      <td>{{ $subscribtion->end }}</td>
                      <td>
                        @if (intval($subscribtion->status) === 0)
                          <span class="text-warning">قيد الإنتظار</span>
                        @elseif(intval($subscribtion->status) === 1)
                          <span class="text-success">نشطة</span>
                        @elseif(intval($subscribtion->status) === 2)
                          <span class="text-danger">منتهية</span>
                        @elseif(intval($subscribtion->status) === 3)
                          <span class="text-danger">ملغية</span>
                        @endif
                      </td>
                      <td>
                        <button class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#editSubscribtionModal" data-subscribtion="{{ $subscribtion }}">
                          <ion-icon name="create-outline"></ion-icon>
                        </button>
                        <button class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#deleteSubscribtionModal" onclick="$('#subscribtion_id_to_destroy').val('{{ $subscribtion->id }}')">
                          <ion-icon name="trash-outline"></ion-icon>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="alert alert-info">لا توجد إشتراكات</div>
            @endif
          </div>
        </div>
      @endif

      <div class="card">
        <div class="card-header">
          <h4 class="fw-bold my-2">إعدادات متقدمة</h4>
          <p class="text-danger">
            <small>
              قد تؤثر بعض الأوامر على العرض، فعند حذف مستخدم سيتم حذف معلوماته من سجل الزبون، ستبقى الفواتير و بعض معلومات الطلب فقط.
            </small>
          </p>
        </div>
        <div class="card-body">
          <div class="mb-3">
            @if ($user->status === 'blocked')
              <button class="btn btn-success btn-lg w-100" data-bs-toggle="modal" data-bs-target="#changeUserStatusModal">
                تنشيط حساب المستخدم
              </button>
            @else
              <button class="btn btn-warning btn-lg w-100" data-bs-toggle="modal" data-bs-target="#changeUserStatusModal">
                تعطيل حساب المستخدم
              </button>
            @endif
          </div>
          <div class="mb-3">
            <button class="btn btn-danger btn-lg w-100" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
              حذف حساب المستخدم
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- START add subscribtions modal -->
  <div class="modal fade" id="addSubscribtionModal" tabindex="-1" aria-labelledby="addSubscribtionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSubscribtionModalLabel">إضافة إشتراك</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.subscribtion.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">نوع الإشتراك: </label>
              <select name="package_id" class="form-control form-control-lg border-2" required>
                <option value="">إختر نوع الإشتراك</option>
                @foreach (App\Models\Package::all() as $package)
                  <option value="{{ $package->id }}">{{ $package->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">تاريخ البداية: </label>
              <input type="date" name="start" class="form-control form-control-lg border-2" required />
            </div>
            <div class="mb-3">
              <label class="form-label">تاريخ النهاية: </label>
              <input type="date" name="end" class="form-control form-control-lg border-2" required />
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="user_id" value="{{ $user->id }}" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
            <button type="submit" class="btn btn-dark">حفظ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END add subscribtions modal -->

  <!-- START edit subscribtions modal -->
  <div class="modal fade" id="editSubscribtionModal" tabindex="-1" aria-labelledby="editSubscribtionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSubscribtionModalLabel">تعديل الإشتراك</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.subscribtion.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">نوع الإشتراك: </label>
              <select name="package_id" class="form-control form-control-lg border-2" id="subscribtion_package_to_update" required>
                <option value="">إختر نوع الإشتراك</option>
                @foreach (App\Models\Package::all() as $package)
                  <option value="{{ $package->id }}">{{ $package->name_ar }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">تاريخ البداية: </label>
              <input type="date" name="start" class="form-control form-control-lg border-2" id="subscribtion_start_to_update" required />
            </div>
            <div class="mb-3">
              <label class="form-label">تاريخ النهاية: </label>
              <input type="date" name="end" class="form-control form-control-lg border-2" id="subscribtion_end_to_update"  required />
            </div>
            <div class="mb-3">
              <label class="form-label">الحالة: </label>
              <select name="status" class="form-control form-control-lg border-2" required id="subscribtion_status_to_update">
                <option value="0">قيد الإنتطار</option>
                <option value="1">نشطة</option>
                <option value="2">منتهية</option>
                <option value="3">ملغية</option>
              </select>
            </div>
            <div class="mb-3" id="subscribtion_proof_view">
              <label class="form-label">إثبات الدفع: </label>
              <img src="" id="subscribtion_proof" width="100%" />
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="subscribtion_id" id="subscribtion_id_to_update"  />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
            <button type="submit" class="btn btn-dark">حفظ</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END edit subscribtions modal -->

  <!-- START destroy subscribtion modal -->
  <div class="modal fade" id="deleteSubscribtionModal" tabindex="-1" aria-labelledby="deleteSubscribtionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">هل حقا تريد حذف الإشتراك؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="" id="subscribtion_id_to_destroy" />
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroySubscribe();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END destroy subscribtion modal -->

  <!-- START destroy user modal -->
  <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">هل حقا تريد حذف المستخدم؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="destroy();">حذف</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END destroy user modal -->

  <!-- START change status user modal -->
  <div class="modal fade" id="changeUserStatusModal" tabindex="-1" aria-labelledby="changeUserStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title">هل حقا تريد تعديل حالة حساب المستخدم؟</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="updateStatus();">تأكيد العملية</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END change status user modal -->
@endsection

@section('scripts')
  <script type="text/javascript">
    function updateStatus() {
      $.post('{{ route('admin.user.settings.status.update') }}', {id:'{{ $user->id }}', _token:'{{ csrf_token() }}'}, function(res) {
        window.location.reload();
      }, 'json');
    }

    function destroy() {
      $.post('{{ route('admin.user.destroy') }}', {id:'{{ $user->id }}', _token:'{{ csrf_token() }}'}, function(res) {
        window.location.assign("{{ route('admin.users', ['type' => 'clients']) }}");
      }, 'json');
    }
  </script>

  @if(intval($user->type) === 2 || intval($user->type) === 3)
    <script type="text/javascript">
      function destroySubscribe() {
        let id = $('#subscribtion_id_to_destroy').val();
        $.post('{{ route('admin.subscribtion.destroy') }}', {id:id, _token:'{{ csrf_token() }}'}, function(res) {
          $('#subscribtion_tr'+id).remove();
        }, 'json');
      }

      $('#editSubscribtionModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var subscribtion = button.data('subscribtion');
        
        var modal = $(this);
        modal.find('#subscribtion_package_to_update').val(subscribtion.package.id);
        modal.find('#subscribtion_start_to_update').val(subscribtion.start);
        modal.find('#subscribtion_end_to_update').val(subscribtion.end);
        modal.find('#subscribtion_status_to_update').val(subscribtion.status);
        modal.find('#subscribtion_id_to_update').val(subscribtion.id);

        if(subscribtion.file)
        {
          modal.find('#subscribtion_proof_view').show();
          modal.find('#subscribtion_proof').attr('src', subscribtion.file);
        }
        else
        {
          modal.find('#subscribtion_proof_view').hide();
        }
      });
    </script>
  @endif
@endsection