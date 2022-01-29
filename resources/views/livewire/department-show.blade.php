<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="w-full bg-white rounded-md shadow-md px-2 py-1">
                <input class="rounded-md" placeholder="ค้นหา..." type="text" wire:model.debounce.500ms="search">
                <x-jet-button type="button" wire:click="new">
                    <x-icon.document-add class="h-4 w-4"></x-icon.document-add>เพิ่ม
                </x-jet-button>
            </div>
            <div>
                <table class="w-full border">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อหน่วยงาน</th>
                            <th>เบอร์โทร</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $key => $dept)
                        <tr class="border">
                            <td class="text-center">{{ $key+1 }}</td>
                            <td>{{ $dept->name }}</td>
                            <td>{{ $dept->phone }}</td>
                            <td>
                                <button class="border rounded-md bg-red-300 px-2" wire:click="edit('{{$dept->id}}')">แก้ไข</button>
                                <button class="border rounded-md bg-red-300 px-2" wire:click="deleteConfirm('{{$dept->id}}')">ลบ</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="showEditModal">
        <x-slot name="title">
            {{ __('ข้อมูลหน่วยงาน') }}
        </x-slot>

        <x-slot name="content">
            <div>
                <x-jet-label for="dept_name" value="{{ __('ชื่อหน่วยงาน') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="dept_name" wire:model="editing.name" required autofocus />
            </div>
            <div>
                <x-jet-label for="dept_phone" value="{{ __('เบอร์โทร') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="dept_phone" wire:modal="editing.ph" required autofocus />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showEditModal', false)" wire:loading.attr="disabled">
                {{ __('ยกเลิก') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('บันทึก') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Delete Team Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingDelete">
        <x-slot name="title">
            {{ __('Delete Department') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('confirmingDelete', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Team') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>