<div class="item-content-schedule">
    <div class="time-detail">
        <input type='text' class="form-control select-date-ticket select-birthday" required name="date[]"/>
    </div>
    <span class="seperate-schedule"></span>
    <div class="address-schedule">
        <p><b>{{$tour}}</b></p>
        <p><b>{{$facility}}</b>{{ ' - ' . $address}}</p>
    </div>
    <span class="seperate-schedule"></span>

    <div class="cost-schedule">
        {{--                                        500k VND - Ticket--}}
    </div>
</div>

<script>

    $('.select-birthday').datepicker({
        language: "vi",
        format: 'yyyy/mm/dd',
        autoclose: true
    });
</script>
