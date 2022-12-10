<div class="el-filemanager" x-data="{ fileSelect: false }">
    <div class="el-filemanager__toolbar p-2">
        <button class="btn btn-primary btn-sm" wire:component="core::common.filemanager.form.input-name({})"><i
                class="bi bi-folder-plus"></i>
        </button>
        <button class="btn btn-primary btn-sm" title="Upload File"
            wire:component="core::common.filemanager.form.upload-file({'path':'{{ $path_current }}','disk':'{{ $disk }}'})">
            <i class="bi bi-cloud-arrow-up"></i>
        </button>
    </div>
    <div class="el-filemanager__body">
        @livewire('core::common.filemanager.folder')
        @livewire('core::common.filemanager.file')
    </div>
    <div class="el-filemanager__footer p-2">
        <span x-show="fileSelect" x-text="fileSelect"></span>
    </div>
    <div x-show="fileSelect&&!!window.eventSelectFile" class=" p-1 text-end"> <button
            class="btn btn-primary btn-sm" x-on:click="eventSelectFile(fileSelect)">Select File</button></div>
</div>
