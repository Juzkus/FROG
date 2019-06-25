using System;
using System.Collections.Generic;
using System.IO;

namespace FROG.DotNet
{
    public static class PropertyParser
    {
        public static IDictionary<string,string> GetPropertiesFromFile(string fileName, char delimeter)
        {
            IDictionary<string, string> props = new Dictionary<string, string>();

            using (var reader = new StreamReader(new BufferedStream(File.OpenRead(fileName))))
            {
                while(!reader.EndOfStream)
                {
                    var kvp = reader.ReadLine().Split(delimeter);
                    props.Add(kvp[0], kvp[1]);
                }
            }

            return props;
        }
    }
}
