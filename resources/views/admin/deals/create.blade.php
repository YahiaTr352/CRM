@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">New Opportunity</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.deals.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Pipeline</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Initiate New Deal</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl">
                        Fill in the details below to add a new sales opportunity to your pipeline.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.deals.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Pipeline</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30">
            <h2 class="text-lg font-bold text-slate-900">Deal Specifications</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Core information about the sales opportunity.</p>
        </div>

        <form method="POST" action="{{ route("admin.deals.store") }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Deal Name -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="deal_name">
                        {{ trans('cruds.deal.fields.deal_name') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-signature text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('deal_name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="deal_name" id="deal_name" value="{{ old('deal_name', '') }}" placeholder="Enter a descriptive name for this deal" required>
                    </div>
                    @if($errors->has('deal_name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('deal_name') }}
                        </p>
                    @endif
                </div>

                <!-- Contact Name -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="contact_name_id">
                        {{ trans('cruds.deal.fields.contact_name') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" name="contact_name_id" id="contact_name_id">
                        @foreach($contact_names as $id => $entry)
                            <option value="{{ $id }}" {{ old('contact_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('contact_name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('contact_name') }}
                        </p>
                    @endif
                </div>

                <!-- Source -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="source_id">
                        {{ trans('cruds.deal.fields.source') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('source') ? 'is-invalid' : '' }}" name="source_id" id="source_id">
                        @foreach($sources as $id => $entry)
                            <option value="{{ $id }}" {{ old('source_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('source'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('source') }}
                        </p>
                    @endif
                </div>

                <!-- Stage -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="stage_id">
                        {{ trans('cruds.deal.fields.stage') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <select class="form-control select2 {{ $errors->has('stage') ? 'is-invalid' : '' }}" name="stage_id" id="stage_id" required>
                        @foreach($stages as $id => $entry)
                            <option value="{{ $id }}" {{ old('stage_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('stage'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('stage') }}
                        </p>
                    @endif
                </div>

                <!-- Amount -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="amount">
                        {{ trans('cruds.deal.fields.amount') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 font-black group-focus-within:text-emerald-500 transition-colors">
                            $
                        </div>
                        <input class="w-full pl-9 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-black text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all {{ $errors->has('amount') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" placeholder="0.00">
                    </div>
                    @if($errors->has('amount'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>

                <!-- Closing Date -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="closing_date">
                        {{ trans('cruds.deal.fields.closing_date') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="far fa-calendar-alt text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 placeholder:font-medium focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all date {{ $errors->has('closing_date') ? 'is-invalid' : '' }}" type="text" name="closing_date" id="closing_date" value="{{ old('closing_date') }}" placeholder="Select expected close date">
                    </div>
                    @if($errors->has('closing_date'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('closing_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="description">
                    {{ trans('cruds.deal.fields.description') }}
                </label>
                <div class="rounded-2xl border border-slate-200 overflow-hidden">
                    <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                </div>
                @if($errors->has('description'))
                    <p class="text-[11px] font-bold text-rose-500 mt-1">
                        {{ $errors->first('description') }}
                    </p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Attachments -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="attachments">
                        {{ trans('cruds.deal.fields.attachments') }}
                    </label>
                    <div class="needsclick dropzone rounded-2xl border-2 border-dashed border-slate-200 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all {{ $errors->has('attachments') ? 'border-rose-300' : '' }}" id="attachments-dropzone">
                        <div class="dz-message" data-dz-message>
                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 mb-2">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-600">Drop files or click to upload</p>
                                <p class="text-[10px] text-slate-400 mt-1">Maximum file size: 20MB</p>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('attachments'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('attachments') }}
                        </p>
                    @endif
                </div>

                <!-- Products -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="products">
                        {{ trans('cruds.deal.fields.products') }}
                    </label>
                    <div class="flex items-center gap-2 mb-3">
                        <button type="button" class="select-all px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">Select All</button>
                        <button type="button" class="deselect-all px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">Deselect All</button>
                    </div>
                    <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple>
                        @foreach($products as $id => $product)
                            <option value="{{ $id }}" {{ in_array($id, old('products', [])) ? 'selected' : '' }}>{{ $product }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('products'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('products') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Submit Section -->
            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.deals.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">
                    Discard Changes
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-3 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-indigo-200 transition-all active:scale-95" type="submit">
                    <i class="fas fa-check-circle"></i>
                    <span>Securely Save Deal</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<style>
    /* Premium Select2 Styling */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        height: auto !important;
        padding: 8px 12px !important;
        background-color: #ffffff !important;
        transition: all 0.2s !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #4f46e5 !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px !important;
        right: 12px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #0f172a !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        padding: 0 !important;
    }

    .select2-dropdown {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        overflow: hidden !important;
    }

    .select2-results__option--highlighted[aria-selected] {
        background-color: #4f46e5 !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 6px !important;
        color: #4f46e5 !important;
        font-weight: 700 !important;
        font-size: 11px !important;
        padding: 2px 8px !important;
        margin-top: 4px !important;
    }

    /* CKEditor Styling Override */
    .ck-editor__editable_inline {
        min-height: 200px !important;
        padding: 1.5rem !important;
        color: #1e293b !important;
        background-color: #ffffff !important;
    }
    
    .ck.ck-editor__main>.ck-editor__editable {
        border-color: #e2e8f0 !important;
    }
    
    .ck.ck-toolbar {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
    }
</style>

<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.deals.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $deal->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedAttachmentsMap = {}
Dropzone.options.attachmentsDropzone = {
    url: '{{ route('admin.deals.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
      uploadedAttachmentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentsMap[file.name]
      }
      $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($deal) && $deal->attachments)
          var files =
            {!! json_encode($deal->attachments) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
