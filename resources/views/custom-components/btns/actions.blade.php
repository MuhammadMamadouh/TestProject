<div>
<a href="{{ $editLink }}" class="" id=""><i data-feather="edit"></i></i>Edit</a>
<form action="{{$deleteLink}}" class="single-del d-inline-block" method="post">
    @csrf  @method("delete")
    <a href="" title="delete" data-id="{{$item->id}} " class="delbtn"><i data-feather="trash" class="text-danger">Delete</a>
</form>

</div>
