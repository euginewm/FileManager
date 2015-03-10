(function ($) {
  $(document).ready(function () {

    var client = new $.RestClient('/chat/api/');
    client.add('chat');

    $('#send-data').click(function () {
      client.chat.create({
        action: 'add-message',
        message: $('textarea').val(),
        recipient_id: $('input[name="to-recipient-id"]').val()
      });

      $('textarea').val('');
    });

    $('#new-room-action button').click(function () {
      client.chat.create({
        action: 'create-room',
        name: $('input[name="new-room"]').val()
      });
    });

    // to debug
    var listn = true;
//        var listn = false;
    var intervalValue = 3000;

    if ( listn ) {
      (function pollMessages() {
        setTimeout(function () {
          $.ajax({ url: "/chat/read-messages", success: function (data) {
            $('#room-area').html(data.html);
            $('.remove-message').click(function () {

              client.chat.del('remove-message/' + $(this).attr('data-id'));

            });
          }, dataType: "json", complete: pollMessages });
        }, intervalValue);
      })();

      (function pollRoomUsers() {
        setTimeout(function () {
          $.ajax({ url: "/chat/read-room-users", success: function (data) {
            $('#room-users').html(data.html);
            $('.room-name').click(function () {
              $.post('/chat/change-room/' + $(this).attr('data-id'));
            });
            $('.remove-room').click(function (e) {
              e.stopPropagation();
              e.preventDefault();

              client.chat.del('remove-room/' + $(this).attr('data-id'));

            });
            $('.send-private-message').click(function () {
              $('input[name="to-recipient-id"]').val($(this).attr('data-id'));
              $('input[name="to-recipient-name"]').val($(this).attr('data-name'));
            });
          }, dataType: "json", complete: pollRoomUsers });
        }, intervalValue);
      })();

    }
  });

})(jQuery);
