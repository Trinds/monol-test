<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://res.cloudinary.com/dl1rvdrha/image/upload/v1697654764/hsbbaxh4q2vddi9yxup3.png" class="logo" alt="Laravel Logo" style="border-radius: 50%">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
