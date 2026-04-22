@extends('layouts.admin')
@section('content')

<div class="max-w-[1200px] mx-auto px-4 md:px-6 lg:px-8 pt-2 md:pt-4 lg:pt-6 space-y-8">
    <!-- Premium Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-slate-200/60 animate-in fade-in slide-in-from-top-4 duration-700">
        <div class="space-y-3">
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 border border-blue-100/50">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Update Mode</span>
                </div>
                <span class="text-slate-300">/</span>
                <a href="{{ route('admin.tasks.index') }}" class="text-[10px] font-bold text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Task Board</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-xl shadow-indigo-100">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Refine Task</h1>
                    <p class="text-slate-500 font-medium text-sm mt-1 max-w-xl leading-relaxed">
                        Modify task parameters for <span class="text-indigo-600 font-bold">ID-{{ str_pad($task->id, 5, '0', STR_PAD_LEFT) }}</span> to reflect current status.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 shadow-sm hover:border-slate-300 hover:text-slate-900 transition-all active:scale-95">
                <i class="fas fa-arrow-left text-slate-400"></i>
                <span>Back to Tasks</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-1000 delay-150">
        <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900">Task Revision</h2>
                <p class="text-slate-500 text-sm mt-1 font-medium">Updating ID: <span class="text-indigo-600 font-bold">#{{ $task->id }}</span></p>
            </div>
            @can('task_show')
                <a href="{{ route('admin.tasks.show', $task->id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 underline decoration-indigo-200 underline-offset-4 transition-all">View details</a>
            @endcan
        </div>

        <form method="POST" action="{{ route("admin.tasks.update", [$task->id]) }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Task Name -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="name">
                        {{ trans('cruds.task.fields.name') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-500 text-slate-400">
                            <i class="fas fa-tasks text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all {{ $errors->has('name') ? 'border-rose-300 bg-rose-50/30' : '' }}" type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required>
                    </div>
                </div>

                <!-- Priority -->
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                        {{ trans('cruds.task.fields.priority') }}
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(App\Models\Task::PRIORITY_RADIO as $key => $label)
                            @php
                                $currentPriority = old('priority', $task->priority);
                                $pColor = 'slate';
                                if($key === 'urgent') $pColor = 'rose';
                                elseif($key === 'high') $pColor = 'amber';
                                elseif($key === 'medium') $pColor = 'indigo';
                                elseif($key === 'low') $pColor = 'emerald';
                            @endphp
                            <label class="relative flex items-center justify-center p-3 rounded-xl border-2 cursor-pointer transition-all hover:bg-slate-50 {{ $currentPriority === $key ? 'border-'.$pColor.'-500 bg-'.$pColor.'-50/30' : 'border-slate-100' }}">
                                <input type="radio" name="priority" value="{{ $key }}" class="hidden" {{ $currentPriority === (string) $key ? 'checked' : '' }}>
                                <span class="text-xs font-black uppercase tracking-tight text-{{ $currentPriority === $key ? $pColor.'-700' : 'slate-500' }}">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="status_id">
                        {{ trans('cruds.task.fields.status') }}
                        <span class="text-rose-500">*</span>
                    </label>
                    <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id" required>
                        @foreach($statuses as $id => $entry)
                            <option value="{{ $id }}" {{ (old('status_id') ? old('status_id') : $task->status->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Assigned To -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="assigned_to_id">
                        {{ trans('cruds.task.fields.assigned_to') }}
                    </label>
                    <select class="form-control select2 {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                        @foreach($assigned_tos as $id => $entry)
                            <option value="{{ $id }}" {{ (old('assigned_to_id') ? old('assigned_to_id') : $task->assigned_to->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Due Date -->
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="due_date">
                        {{ trans('cruds.task.fields.due_date') }}
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                            <i class="fas fa-calendar-alt text-sm"></i>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-900 date" type="text" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date) }}" placeholder="Select due date">
                    </div>
                </div>

                <!-- Tags -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="tags">
                        {{ trans('cruds.task.fields.tag') }}
                    </label>
                    <div class="flex items-center gap-2 mb-3">
                        <button type="button" class="select-all px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">Select All</button>
                        <button type="button" class="deselect-all px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">Deselect All</button>
                    </div>
                    <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                        @foreach($tags as $id => $tag)
                            <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $task->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2" for="description">
                        {{ trans('cruds.task.fields.description') }}
                    </label>
                    <div class="rounded-2xl border border-slate-200 overflow-hidden">
                        <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $task->description) !!}</textarea>
                    </div>
                </div>

                <!-- Attachments -->
                <div class="space-y-2 md:col-span-2">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-widest flex items-center gap-2">
                        {{ trans('cruds.task.fields.attachment') }}
                    </label>
                    <div class="needsclick dropzone rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 hover:bg-indigo-50/30 hover:border-indigo-300 transition-all duration-300" id="attachment-dropzone">
                        <div class="dz-message" data-dz-message>
                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-slate-400 mb-3 group-hover:text-indigo-500 transition-colors">
                                    <i class="fas fa-cloud-upload-alt text-xl"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-600">Drop files here or click to upload</p>
                                <p class="text-xs font-medium text-slate-400 mt-1">Maximum file size: 10 MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.tasks.index') }}" class="px-8 py-3.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">
                    Cancel Changes
                </a>
                <button type="submit" class="px-10 py-3.5 bg-indigo-600 rounded-xl text-sm font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('styles')
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
        z-index: 9999 !important;
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.tasks.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';
                xhr.addEventListener('error', function() { reject(`Couldn't upload file: ${ file.name }.`) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;
                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${xhr.status} ${response.message}` : `${xhr.status} ${xhr.statusText}`);
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
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $task->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(allEditors[i], { extraPlugins: [SimpleUploadAdapter] });
  }

  // Handle priority selection UI
  $('input[name="priority"]').on('change', function() {
      $('input[name="priority"]').closest('label').removeClass('border-rose-500 border-amber-500 border-indigo-500 border-emerald-500 bg-rose-50/30 bg-amber-50/30 bg-indigo-50/30 bg-emerald-50/30').addClass('border-slate-100');
      $('input[name="priority"]').closest('label').find('span').removeClass('text-rose-700 text-amber-700 text-indigo-700 text-emerald-700').addClass('text-slate-500');
      
      let val = $(this).val();
      let color = 'slate';
      if(val === 'urgent') color = 'rose';
      else if(val === 'high') color = 'amber';
      else if(val === 'medium') color = 'indigo';
      else if(val === 'low') color = 'emerald';
      
      $(this).closest('label').removeClass('border-slate-100').addClass('border-'+color+'-500 bg-'+color+'-50/30');
      $(this).closest('label').find('span').removeClass('text-slate-500').addClass('text-'+color+'-700');
  });
});
</script>

<script>
    var uploadedAttachmentMap = {}
Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.tasks.storeMedia') }}',
    maxFilesize: 10,
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
    params: { size: 10 },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
      uploadedAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = typeof file.file_name !== 'undefined' ? file.file_name : uploadedAttachmentMap[file.name]
      $('form').find('input[name="attachment[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($task) && $task->attachment)
          var files = {!! json_encode($task->attachment) !!}
          for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachment[]" value="' + file.file_name + '">')
          }
@endif
    }
}
</script>
@endsection
