@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<span class="brand-mark">{!! $slot !!}</span>
</a>
</td>
</tr>
