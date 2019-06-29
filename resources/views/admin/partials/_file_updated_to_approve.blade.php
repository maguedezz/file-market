@component('files.partials._file', compact('file'))
    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    <a href="">Preview Changes </a>
                </p>
                <p class="level-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('approve-{{ $file->id }}').submit();">Approve</a>
                </p>

                <form action="{{ route('admin.files.updated.update',$file->identifier) }}" id="approve-{{ $file->id }}" method="POST" class="is-hidden">
                    @csrf
                    @method('PATCH')
                </form>
                <p class="level-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('reject-{{ $file->id }}').submit();">Reject</a>
                </p>
                <form action="{{ route('admin.files.updated.destroy',$file->identifier) }}" id="reject-{{ $file->id }}" method="POST" class="is-hidden">
                    @csrf
                    @method('DELETE')
                </form>
                
            </div>
        </div>
    @endslot
@endcomponent