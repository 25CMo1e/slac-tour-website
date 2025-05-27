$(document).ready(function () {
    // Handle floor selection button clicks
    $('.floor-selector .list-group-item').on('click', function () {
        var floor = $(this).data('floor');
        
        // 处理地下室按钮的特殊逻辑
        if (floor === 0) {
            $('.sub-floor-buttons').slideToggle();
            $('.sub-floor-buttons-second').slideUp();
            $('.sub-floor-buttons-third').slideUp();
            $('.sub-floor-buttons-fourth').slideUp();
            $('.sub-floor-buttons-sixth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示地下室楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-0').addClass('active');
            return;
        }

        // 处理第二层按钮的特殊逻辑
        if (floor === 2) {
            $('.sub-floor-buttons-second').slideToggle();
            $('.sub-floor-buttons').slideUp();
            $('.sub-floor-buttons-third').slideUp();
            $('.sub-floor-buttons-fourth').slideUp();
            $('.sub-floor-buttons-sixth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示第二层楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-2').addClass('active');
            return;
        }

        // 处理第三层按钮的特殊逻辑
        if (floor === 3) {
            $('.sub-floor-buttons-third').slideToggle();
            $('.sub-floor-buttons').slideUp();
            $('.sub-floor-buttons-second').slideUp();
            $('.sub-floor-buttons-fourth').slideUp();
            $('.sub-floor-buttons-sixth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示第三层楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-3').addClass('active');
            return;
        }

        // 处理第四层按钮的特殊逻辑
        if (floor === 4) {
            $('.sub-floor-buttons-fourth').slideToggle();
            $('.sub-floor-buttons').slideUp();
            $('.sub-floor-buttons-second').slideUp();
            $('.sub-floor-buttons-third').slideUp();
            $('.sub-floor-buttons-sixth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示第四层楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-4').addClass('active');
            return;
        }

        // 处理第五层按钮的特殊逻辑
        if (floor === 5) {
            $('.sub-floor-buttons-fifth').slideToggle();
            $('.sub-floor-buttons').slideUp();
            $('.sub-floor-buttons-second').slideUp();
            $('.sub-floor-buttons-third').slideUp();
            $('.sub-floor-buttons-fourth').slideUp();
            $('.sub-floor-buttons-sixth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示第五层楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-5').addClass('active');
            return;
        }

        // 处理第六层按钮的特殊逻辑
        if (floor === 6) {
            $('.sub-floor-buttons-sixth').slideToggle();
            $('.sub-floor-buttons').slideUp();
            $('.sub-floor-buttons-second').slideUp();
            $('.sub-floor-buttons-third').slideUp();
            $('.sub-floor-buttons-fourth').slideUp();
            // 移除其他楼层的active状态
            $('.floor-selector .list-group-item').not(this).removeClass('active');
            $(this).addClass('active');
            // 显示第六层楼层图
            $('.floor-plan').removeClass('active');
            $('#floor-6').addClass('active');
            return;
        }

        // 处理其他楼层按钮
        // 隐藏所有子楼层按钮
        $('.sub-floor-buttons').slideUp();
        $('.sub-floor-buttons-second').slideUp();
        $('.sub-floor-buttons-third').slideUp();
        $('.sub-floor-buttons-fourth').slideUp();
        $('.sub-floor-buttons-sixth').slideUp();
        
        // Remove active class from all buttons and add to the clicked one
        $('.floor-selector .list-group-item').removeClass('active');
        $(this).addClass('active');

        // Hide all floor plans and show the selected one
        $('.floor-plan').removeClass('active');
        $('#floor-' + floor).addClass('active');
    });

    // 处理子楼层按钮点击
    $('.sub-floor').on('click', function() {
        var subFloor = $(this).data('sub-floor');
        
        // 移除所有子楼层按钮的active状态
        $('.sub-floor').removeClass('active');
        // 添加当前按钮的active状态
        $(this).addClass('active');
        
        // 显示对应的子楼层图片
        $('.floor-plan').removeClass('active');
        $('#sub-floor-' + subFloor).addClass('active');
    });

    // // Handle hotspot clicks on the floor plan images
    // $('map area').on('click', function (e) {
    //     e.preventDefault(); // Prevent default link behavior

    //     var locationKey = $(this).data('location');
    //     // 0x13E8FE
    //     // Fetch location details (this would typically come from an API or a data structure)
    //     // For this example, we'll use a simple hardcoded object
    //     var locationDetails = {
    //         'basement-location-1': {
    //             name: 'Basement Location 1',
    //             description: 'Details about Basement Location 1.',
    //             image: 'img/locations/default.jpg', // Replace with actual image
    //             features: ['Feature A', 'Feature B'],
    //             hours: 'Monday - Friday, 9:00 AM - 5:00 PM'
    //         },
    //         'lobby': {
    //             name: 'Main Lobby',
    //             description: 'The main entrance and reception area.',
    //             image: 'img/locations/lobby.jpg', // Replace with actual image
    //             features: ['Information Desk', 'Seating Area'],
    //             hours: 'Open 24/7'
    //         },
    //         'cafeteria': {
    //             name: 'University Cafeteria',
    //             description: 'A place to grab food and drinks.',
    //             image: 'img/locations/cafeteria.jpg', // Replace with actual image
    //             features: ['Variety of Food Options', 'Seating'],
    //             hours: 'Monday - Friday, 7:00 AM - 7:00 PM'
    //         },
    //         'study-room-1': {
    //             name: 'Study Room 1',
    //             description: 'A quiet room for individual or group study.',
    //             image: 'img/locations/study-room.jpg', // Replace with actual image
    //             features: ['Tables', 'Chairs', 'Whiteboard'],
    //             hours: 'Open 24/7'
    //         },
    //         'computer-lab': {
    //             name: 'Computer Lab',
    //             description: 'Equipped with computers and internet access.',
    //             image: 'img/locations/computer-lab.jpg', // Replace with actual image
    //             features: ['Computers', 'Printers', 'Internet'],
    //             hours: 'Monday - Friday, 8:00 AM - 10:00 PM'
    //         },
    //         'third-location-1': {
    //             name: 'Third Location 1',
    //             description: 'Details about Third Location 1.',
    //             image: 'img/locations/default.jpg', // Replace with actual image
    //             features: ['Feature C', 'Feature D'],
    //             hours: 'Monday - Friday, 9:00 AM - 5:00 PM'
    //         },
    //         'fourth-location-1': {
    //             name: 'Fourth Location 1',
    //             description: 'Details about Fourth Location 1.',
    //             image: 'img/locations/default.jpg', // Replace with actual image
    //             features: ['Feature E', 'Feature F'],
    //             hours: 'Monday - Friday, 9:00 AM - 5:00 PM'
    //         },
    //         'fifth-location-1': {
    //             name: 'Fifth Location 1',
    //             description: 'Details about Fifth Location 1.',
    //             image: 'img/locations/default.jpg', // Replace with actual image
    //             features: ['Feature G', 'Feature H'],
    //             hours: 'Monday - Friday, 9:00 AM - 5:00 PM'
    //         },
    //         'sixth-location-1': {
    //             name: 'Sixth Location 1',
    //             description: 'Details about Sixth Location 1.',
    //             image: 'img/locations/default.jpg', // Replace with actual image
    //             features: ['Feature I', 'Feature J'],
    //             hours: 'Monday - Friday, 9:00 AM - 5:00 PM'
    //         }
    //         // Add more locations as needed
    //     };

//         var details = locationDetails[locationKey];

//         if (details) {
//             // Populate the modal with details
//             $('#location-image').attr('src', details.image);
//             $('#location-name').text(details.name);
//             $('#location-description').text(details.description);

//             // Populate features list
//             var featuresList = $('#location-features');
//             featuresList.empty(); // Clear previous features
//             details.features.forEach(function (feature) {
//                 featuresList.append('<li>' + feature + '</li>');
//             });

//             $('#location-hours').text(details.hours);

//             // Show the modal (Bootstrap's data-target handles this, but good to have explicit code if needed)
//             // $('#locationModal').modal('show');
//         } else {
//             console.error('Location details not found for key:', locationKey);
//         }
//     });

//     // Ensure the first floor is active on load (matching the HTML default)
    $('.floor-selector .list-group-item.active').trigger('click');
});