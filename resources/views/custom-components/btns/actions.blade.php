<div>
    @if (isset($editLink))
    <a href="{{ $editLink }}" class="" id="">
      <i class="" data-feather="shopping-bag"></i>
        Edit</a>
    @endif
    @if (isset($deleteLink))
    <form action="{{$deleteLink}}" class="single-del d-inline-block" method="post">
        @csrf @method("delete")
        <a href="" title="delete" data-id="{{$item->id}} " class="delbtn"><i data-feather="trash"
                class="text-danger">Delete</a>
    </form>
    @endif
</div>
