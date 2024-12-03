const pusher = new Pusher(pusherAppKey, {
  cluster: pusherCluster,
  encrypted: true,
});

const channel = pusher.subscribe('channel-votes');
channel.bind('notification-votes', function (notification) {
  console.log(`New notification: ${Object.entries(notification.notification)}`);
});
