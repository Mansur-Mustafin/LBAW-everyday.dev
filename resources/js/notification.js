if (userId) {
  const pusher = new Pusher(pusherAppKey, {
    cluster: pusherCluster,
    encrypted: true,
  });

  const channel = pusher.subscribe(`user.${userId}`);

  channel.bind('notification-personal', function (notification) {
    console.log(`New notification: ${Object.entries(notification.notification)}`);
  });
}
