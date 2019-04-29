using frontend;
using MessageBroker;
using MessageBroker.Messages;
using System;
using System.Threading;

namespace Sender
{
    class Program
    {
        static void Main(string[] args)
        {
            Log log = Log.Instance;
            log.Welcome();
            log.ShowDebugMessages(true);
            log.LogMessage("Hello world!", "debug");
            log.LogMessage("Hello world!", "info");
            log.LogMessage("Hello world!", "warning");
            log.LogMessage("Hello world!", "error");

            Connection connection = Connection.Instance;

            IMessageHandler messageHandler = new MessageHandler();

            connection.OpenConnection("amqFrontend", "amqFrontend", "10.3.56.10", "Frontend", messageHandler);

            Publisher publisher = Publisher.Instance;

            Thread.Sleep(1000);

            BezoekerMessage message = new BezoekerMessage
            {
                header = new BezoekerMessageHeader
                {

                },

                body = new BezoekerMessageBody
                {
                    bezoekerUUID = Guid.NewGuid()
                }
            };

            publisher.NewMessage(message);


        }
    }
}
