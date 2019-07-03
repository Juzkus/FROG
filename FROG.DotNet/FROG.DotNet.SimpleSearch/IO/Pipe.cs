using System;
using System.Collections.Generic;
using System.IO;
using System.IO.Pipes;
using System.Text;

namespace FROG.DotNet.SimpleSearch.IO
{
    public enum PipeType
    {
        CLIENT,
        SERVER
    };

    public class Pipe
    {
        private PipeStream stream;
        private AsyncCallback onMessageCallback;

        public Pipe(string name, PipeType type, AsyncCallback callback)
        {
            if (type == PipeType.CLIENT)
            {
                stream = new System.IO.Pipes.NamedPipeClientStream(name);
            }
            else
            {
                stream = new System.IO.Pipes.NamedPipeServerStream(name, System.IO.Pipes.PipeDirection.InOut);
            }
        }

        public string GetMessage()
        {
            if (stream.CanRead)
            {
                try
                {
                    using (var reader = new StreamReader(stream, Encoding.UTF8))
                    {
                        return reader.ReadToEnd();
                    }
                }
                catch { }                
            }

            return string.Empty;
        }
    }
}
