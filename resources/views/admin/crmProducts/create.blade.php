@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8 pb-12">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 border border-indigo-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest">New Asset</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.crm-products.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Catalog</a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-plus text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Register Product</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Introduce a new SKU unit to your strategic inventory catalog.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.crm-products.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Catalog</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Asset Specifications</h2>
                <p class="text-slate-500 text-sm mt-1 font-medium">Define the core attributes and market valuation.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white border border-slate-200 shadow-sm">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</span>
                    <div class="form-check p-0 min-h-0 flex items-center">
                        <input type="hidden" name="product_active" value="0" form="product-form">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="product_active" id="product_active" value="1" {{ old('product_active', 0) == 1 || old('product_active') === null ? 'checked' : '' }} class="sr-only peer" form="product-form">
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600"></div>
                            <span class="ml-2 text-xs font-bold text-slate-600 peer-checked:text-indigo-600">Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <form id="product-form" method="POST" action="{{ route("admin.crm-products.store") }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-10">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                <!-- Product Image -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="product_image">
                        {{ trans('cruds.crmProduct.fields.product_image') }}
                    </label>
                    <div class="needsclick dropzone rounded-2xl border-2 border-dashed border-slate-200 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all {{ $errors->has('product_image') ? 'border-rose-300 bg-rose-50/30' : '' }}" id="product_image-dropzone">
                        <div class="dz-message" data-dz-message>
                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500 mb-3 shadow-sm">
                                    <i class="fas fa-cloud-upload-alt text-lg"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-600">Drop asset image or click to upload</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Recommended: 800x800px • Max 5MB</p>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('product_image'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('product_image') }}
                        </p>
                    @endif
                </div>

                <!-- Product Name -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="product_name">
                        {{ trans('cruds.crmProduct.fields.product_name') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-tag text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('product_name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="product_name" id="product_name" value="{{ old('product_name', '') }}" placeholder="e.g. Enterprise License" required>
                    </div>
                    @if($errors->has('product_name'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('product_name') }}
                        </p>
                    @endif
                </div>

                <!-- Product Code -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="product_code">
                        {{ trans('cruds.crmProduct.fields.product_code') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-barcode text-sm"></i>
                        </div>
                        <input class="w-full h-12 pl-11 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all {{ $errors->has('product_code') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="product_code" id="product_code" value="{{ old('product_code', '') }}" placeholder="SKU-XXXX-XXXX">
                    </div>
                    @if($errors->has('product_code'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('product_code') }}
                        </p>
                    @endif
                </div>

                <!-- Product Category -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="product_category_id">
                        {{ trans('cruds.crmProduct.fields.product_category') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('product_category') ? 'is-invalid' : '' }}" name="product_category_id" id="product_category_id">
                        @foreach($product_categories as $id => $entry)
                            <option value="{{ $id }}" {{ old('product_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('product_category'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('product_category') }}
                        </p>
                    @endif
                </div>

                <!-- Unit Price -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="unit_price">
                        {{ trans('cruds.crmProduct.fields.unit_price') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none font-black text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                            $
                        </div>
                        <input class="w-full h-12 pl-9 pr-4 bg-slate-50/50 border border-slate-200 rounded-xl text-sm font-black text-slate-900 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all {{ $errors->has('unit_price') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="number" name="unit_price" id="unit_price" value="{{ old('unit_price', '') }}" step="0.01" placeholder="0.00">
                    </div>
                    @if($errors->has('unit_price'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('unit_price') }}
                        </p>
                    @endif
                </div>

                <!-- Description -->
                <div class="space-y-3 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="description">
                        {{ trans('cruds.crmProduct.fields.description') }}
                    </label>
                    <div class="rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                        <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                    </div>
                    @if($errors->has('description'))
                        <p class="text-[11px] font-bold text-rose-500 mt-1">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Submit Section -->
            <div class="pt-10 border-t border-slate-100 flex items-center justify-end gap-6">
                <a href="{{ route('admin.crm-products.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                    Discard Entry
                </a>
                <button class="inline-flex items-center gap-2.5 px-8 py-4 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95" type="submit">
                    <i class="fas fa-plus-circle"></i>
                    <span>Initialize Product Asset</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<style>
    /* Premium Select2 Styling - Glass Morphic Feel */
    .select2-container--default .select2-selection--single {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        min-height: 48px !important;
        padding: 8px 12px !important;
        background-color: #f8fafc !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #4f46e5 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px !important;
        right: 12px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #0f172a !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        padding: 0 !important;
        line-height: 30px !important;
    }

    .select2-dropdown {
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        overflow: hidden !important;
        margin-top: 8px !important;
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px) !important;
    }

    .select2-results__option {
        padding: 10px 16px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #475569 !important;
    }

    .select2-results__option--highlighted[aria-selected] {
        background-color: #4f46e5 !important;
        color: #ffffff !important;
    }

    /* CKEditor Styling Override */
    .ck-editor__editable_inline {
        min-height: 250px !important;
        padding: 2rem !important;
        color: #1e293b !important;
        background-color: #ffffff !important;
        font-family: 'Inter', sans-serif !important;
        line-height: 1.6 !important;
    }
    
    .ck.ck-editor__main>.ck-editor__editable {
        border: 1px solid #e2e8f0 !important;
        border-bottom-left-radius: 16px !important;
        border-bottom-right-radius: 16px !important;
    }
    
    .ck.ck-toolbar {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
        padding: 0.5rem !important;
    }

    /* Dropzone Customization */
    .dropzone {
        min-height: 160px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
</style>

<script>
    Dropzone.options.productImageDropzone = {
    url: '{{ route('admin.crm-products.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="product_image"]').remove()
      $('form').append('<input type="hidden" name="product_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="product_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($crmProduct) && $crmProduct->product_image)
      var file = {!! json_encode($crmProduct->product_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="product_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
                xhr.open('POST', '{{ route('admin.crm-products.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $crmProduct->id ?? 0 }}');
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

@endsection
