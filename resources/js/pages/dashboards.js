setInterval(function(){
    if(document.location.href.indexOf('operational') > -1){
        $.ajax({
            type:"GET",
            url:"operational/charts",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $usage = ((data.memory_usage/data.memory_limit)*100).toFixed(2)
                $("#BarMemoryUsage").find(".percentage-label").first().html($usage+"%")
                $("#BarMemoryUsage").find(".percentage-value").width($usage+"%")
                $("#BarMemoryUsage").find(".percentage-value").attr("aria-valuenow",$usage)
                $usage = ((data.memory_peak_usage/data.memory_limit)*100).toFixed(2)
                $("#BarMemoryUsagePeak").find(".percentage-label").first().html($usage+"%")
                $("#BarMemoryUsagePeak").find(".percentage-value").width($usage+"%")
                $("#BarMemoryUsagePeak").find(".percentage-value").attr("aria-valuenow",$usage)
                $usage = (((data.disk_total_space-data.disk_free_space)/data.disk_total_space)*100).toFixed(2)
                $("#BarDiscUsage").find(".percentage-label").first().html($usage+"%")
                $("#BarDiscUsage").find(".percentage-value").width($usage+"%")
                $("#BarDiscUsage").find(".percentage-value").attr("aria-valuenow",$usage)
            },
            error: function(data){
                console.log(data);
            }
        });
    }
    else if(document.location.href.indexOf('management') > -1){
        $.ajax({
            type:"GET",
            url:"management/charts",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $("#userActiveCount").html(data.userActiveCount);
                $("#userActiveLastWeek").html(data.userActiveLastWeek);
                $("#profileCount").html(data.profileCount);
                $("#packageCount").html(data.packageCount);
            },
            error: function(data){
                console.log(data);
            }
        });
    }
}, 1000);


